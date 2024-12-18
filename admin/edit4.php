<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'], $_POST['status']) || empty($_POST['id']) || empty($_POST['status'])) {
        die('Липсващи параметри за актуализация.');
    }

    $id = intval($_POST['id']);
    $status = htmlspecialchars($_POST['status']);


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $coverImage = $_FILES['image']['name'];
        

        $targetDir = "images/slideralbums/";
        $targetFile = $targetDir . basename($coverImage);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $update_query = "UPDATE slider SET cover_image = ?, status = ? WHERE id = ?";
            $stmt = $conn->prepare($update_query);

            if (!$stmt) {
                die('Грешка при подготовката на заявката: ' . $conn->error);
            }

            $stmt->bind_param("ssi", $coverImage, $status, $id);
        } else {
            die('Грешка при качването на изображението.');
        }
    } else {

        $update_query = "UPDATE slider SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);

        if (!$stmt) {
            die('Грешка при подготовката на заявката: ' . $conn->error);
        }

        $stmt->bind_param("si", $status, $id);
    }

    if ($stmt->execute()) {
        echo "<p>Слайдерът е успешно актуализиран!</p>";
    } else {
        echo "<p>Грешка при актуализацията: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die('Липсващ или невалиден параметър.');
    }

    $id = intval($_GET['id']);

    $query = "SELECT * FROM slider WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('Грешка при подготовката на заявката: ' . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Слайдерът не е намерен.');
    }

    $slider = $result->fetch_assoc();
    $stmt->close();
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
  <title>Редактиране на Слайдер</title>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Редактиране на слайдер</h1>
            </div>
            <div class="col-sm-6">
              <a href="view-slider.php" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> Виж Слайдери</a>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-8">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($slider)): ?>
              <form action="edit4.php" method="post" enctype="multipart/form-data">
                <div class="card card-outline card-info">
                  <div class="card-header">
                    <div class="form-group">
                      <label>Статус</label>
                      <select name="status" class="form-control" required>
                        <option value="visible" <?= $slider['status'] == 'visible' ? 'selected' : '' ?>>Visible</option>
                        <option value="hidden" <?= $slider['status'] == 'hidden' ? 'selected' : '' ?>>Hidden</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Снимка на слайдера</label>
                      <?php if (!empty($slider['cover_image'])): ?>
                        <div>
                          <img src="images/slideralbums/<?= htmlspecialchars($slider['cover_image']) ?>" alt="Слайдер" style="max-width: 100px; max-height: 100px;">
                        </div>
                      <?php endif; ?>
                      <input type="file" name="image" id="image" class="form-control-file">
                    </div>
                  </div>
                  <input type="hidden" name="id" value="<?= htmlspecialchars($slider['id']) ?>">
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Запази</button>
                  </div>
                </div>
              </form>
            <?php endif; ?>
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
