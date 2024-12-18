<?php
include "conn.php";

$category = $_GET['category'] ?? '';
$tableMap = [
    'Категория 1' => 'kids_shoes_products',
    'Категория 2' => 'kids_pants_products',
    'Категория 3' => 'kids_shirts_products',
];


if (!empty($category) && isset($tableMap[$category])) {
    $tableName = $tableMap[$category];
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    echo json_encode($products);
} else {
  
    echo json_encode([]);
}

$conn->close();
?>
