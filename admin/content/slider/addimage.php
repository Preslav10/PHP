<?php
include "content/database/conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (isset($_FILES['slider_cover']) && $_FILES['slider_cover']['error'] == UPLOAD_ERR_OK) {
        $coverTmpName = $_FILES['slider_cover']['tmp_name'];
        $coverName = uniqid() . '-' . basename($_FILES['slider_cover']['name']);
        $coverFolder = __DIR__ . "/images/slideralbums/" . $coverName;

        $fileType = mime_content_type($coverTmpName);
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($fileType, $allowedTypes)) {
            die('Невалиден тип на файл. Допустими са само JPEG и PNG изображения.');
        }

   
        if (!is_dir(__DIR__ . "/images/slideralbums")) {
            mkdir(__DIR__ . "/images/slideralbums", 0777, true);
        }

        if (move_uploaded_file($coverTmpName, $coverFolder)) {
         
            $status = isset($_POST['is_visible']) ? $_POST['is_visible'] : 1; 

            $stmt = $conn->prepare("INSERT INTO slider (cover_image, status) VALUES (?, ?)");
            $stmt->bind_param("si", $coverName, $status); 
            if (!$stmt->execute()) {
                error_log('Error inserting slider album: ' . $stmt->error);
                die('Неуспешно добавяне на албум.');
            }
            $stmt->close();
        } else {
            die('Неуспешно качване на изображение.');
        }
    } else {
        die('Грешка при качване на изображението.');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Качване на изображения</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-8">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">Качване на снимка</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="slider_cover">Изображение</label>
                  <input type="file" name="slider_cover" id="slider_cover" class="form-control-file">
                  <div id="slider_cover_preview"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="is_visible">Видимост</label>
                <select name="is_visible" id="is_visible" class="form-control">
                  <option value="1">Видима</option>
                  <option value="0">Скрита</option>
                </select>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Запази</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
