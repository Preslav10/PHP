<?php 
include "content/database/conn.php";

$id = 0;
$product_id = 0;        
$product_name = '';    
$price = 0.00;          
$image = '';           
$album_images = [];     

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $product_name = htmlspecialchars(trim($_POST['title']), ENT_QUOTES, 'UTF-8');
    $price = floatval($_POST['price']);
    $is_visible = isset($_POST['is_visible']) ? intval($_POST['is_visible']) : 0;
    

    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = uniqid() . basename($_FILES['image']['name']);
        $imageFolder = __DIR__ . "/images/albums/" . $imageName;

        $fileType = mime_content_type($imageTmpName);
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($fileType, $allowedTypes)) {
            die('Невалиден тип на файл. Допустими са само JPEG и PNG изображения.');
        }

        if (!is_dir(__DIR__ . "/images/albums")) {
            mkdir(__DIR__ . "/images/albums", 0777, true);
        }

        if (move_uploaded_file($imageTmpName, $imageFolder)) {
            $imagePath = $imageName;
        } else {
            error_log("Грешка при качване на основното изображение: " . $_FILES['image']['error']);
            die('Неуспешно качване на изображението.');
        }
    }

    $galleryImages = [];
    if (isset($_FILES['gallery'])) {
        foreach ($_FILES['gallery']['name'] as $key => $name) {
            $tmpName = $_FILES['gallery']['tmp_name'][$key];
            $error = $_FILES['gallery']['error'][$key];
            if ($error === UPLOAD_ERR_OK && !empty($tmpName)) {
                $fileType = mime_content_type($tmpName);
                $allowedTypes = ['image/jpeg', 'image/png'];
                if (in_array($fileType, $allowedTypes)) {
                    $imgName = uniqid() . basename($name);
                    $folder = __DIR__ . "/images/photos/" . $imgName;

                    if (!is_dir(__DIR__ . "/images/photos")) {
                        mkdir(__DIR__ . "/images/photos", 0777, true);
                    }

                    if (move_uploaded_file($tmpName, $folder)) {
                        $galleryImages[] = $imgName;
                    } else {
                        error_log("Грешка при качване на изображение от галерията: " . $error);
                        die('Неуспешно качване на изображение.');
                    }
                } else {
                    die('Невалиден тип на файл в галерията. Допустими са само JPEG и PNG изображения.');
                }
            }
        }
    }

    
    if ($product_id) {
     
        $stmt = $conn->prepare("UPDATE kids_pants_products SET product_name = ?, price = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $product_name, $price, $imagePath, $product_id);
    } else {
       
        $stmt = $conn->prepare("INSERT INTO kids_pants_products (product_name, price, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $product_name, $price, $imagePath);
    }

    if ($stmt->execute()) {
        $product_id = $stmt->insert_id; 
        $stmt->close();


        if (!empty($galleryImages)) {
            foreach ($galleryImages as $imgName) {
                $stmt = $conn->prepare("INSERT INTO kids_pants_photos (product_id, photo_path) VALUES (?, ?)");
                $stmt->bind_param("is", $product_id, $imgName);
                $stmt->execute();
                $stmt->close();
            }
        }

        echo "<script>alert('Продуктът е записан успешно');</script>";
        echo "<script>window.location.href = '?page=kids/viewkids';</script>";
    } else {
        die('Грешка при записването на продукта: ' . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <title>Добавяне на Продукт</title>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Добави продукт</h1>
            </div>
            <div class="col-sm-6">
              <a href="?page=kids/viewkids" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> Виж Продукти</a>
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
                  <div class="form-group">
                    <label>Въведете заглавие</label>
                    <input name="title" type="text" class="form-control" placeholder="Въведете ...">
                  </div>
                  <div class="form-group">
                    <label>Въведете цена</label>
                    <input name="price" type="text" class="form-control" placeholder="Въведете цена ...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="is_visible">Видимост</label>
                  <select name="is_visible" id="is_visible" class="form-control">
                    <option value="1">Видима</option>
                    <option value="0">Скрита</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="image">Снимка на продукта</label>
                  <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <div class="form-group">
                  <label for="gallery">Галерия на продукта</label>
                  <input type="file" name="gallery[]" id="gallery" class="form-control-file" multiple>
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
