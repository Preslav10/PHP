<?php
include "conn.php";

$tableMap = [
    'Категория 1' => 'men_shoes_products',
    'Категория 2' => 'men_pants_products',
    'Категория 3' => 'men_shirts_products',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'], $_POST['category']) || empty($_POST['id']) || empty($_POST['category'])) {
        die('Липсващи параметри за актуализация.');
    }

    $id = intval($_POST['id']);
    $category = htmlspecialchars($_POST['category']);
    $product_name = htmlspecialchars($_POST['title']);
    $price = floatval($_POST['price']);

    if (!isset($tableMap[$category])) {
        die('Невалидна категория.');
    }

    $tableName = $tableMap[$category];

    $update_query = "UPDATE $tableName SET product_name = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);

    if (!$stmt) {
        die('Грешка при подготовката на заявката: ' . $conn->error);
    }

    $stmt->bind_param("sdi", $product_name, $price, $id);

    if ($stmt->execute()) {
        echo "<p>Продуктът е успешно актуализиран!</p>";
    } else {
        echo "<p>Грешка при актуализацията: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'], $_GET['category']) || empty($_GET['id']) || empty($_GET['category'])) {
        die('Липсващ или невалиден параметър.');
    }

    $id = intval($_GET['id']);
    $category = htmlspecialchars($_GET['category']);

    if (!isset($tableMap[$category])) {
        die('Невалидна категория.');
    }

    $tableName = $tableMap[$category];
    $query = "SELECT * FROM $tableName WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('Грешка при подготовката на заявката: ' . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Продуктът не е намерен.');
    }

    $product = $result->fetch_assoc();
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
  <title>Редактиране на Продукт</title>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Редактиране на продукт</h1>
            </div>
            <div class="col-sm-6">
              <a href="view-slider.php" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> Виж Продукти</a>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-8">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($product)): ?>
              <form action="edit.php" method="post" enctype="multipart/form-data">
                <div class="card card-outline card-info">
                  <div class="card-header">
                    <div class="form-group">
                      <label>Име на продукта</label>
                      <input name="title" type="text" class="form-control" value="<?= htmlspecialchars($product['product_name']) ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Цена</label>
                      <input name="price" type="text" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required>
                    </div>
                  </div>
                  <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                  <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
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
