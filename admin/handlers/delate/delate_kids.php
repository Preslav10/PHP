<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datas";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableMap = [
    'Категория 1' => 'kids_shoes_products',
    'Категория 2' => 'kids_pants_products',
    'Категория 3' => 'kids_shirts_products',
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'], $_POST['category']) || empty($_POST['id']) || empty($_POST['category'])) {
        die('Липсващи параметри за изтриване.');
    }

    $id = intval($_POST['id']);
    $category = htmlspecialchars($_POST['category']);

    if (!isset($tableMap[$category])) {
        die('Невалидна категория.');
    }

    $tableName = $tableMap[$category];

    $delete_query = "DELETE FROM $tableName WHERE id = ?";
    $stmt = $conn->prepare($delete_query);

    if (!$stmt) {
        die('Грешка при подготовката на заявката: ' . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Продуктът беше успешно изтрит.";
    } else {
        die('Грешка при изпълнението на заявката: ' . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
