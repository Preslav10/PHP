<?php
include "conn.php";

$productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$category = isset($_POST['category']) ? $_POST['category'] : '';

if ($productId > 0 && !empty($category)) {

    $allowedCategories = [
        'men_shoes', 'men_pants', 'men_shirts',
        'women_shoes', 'women_pants', 'women_shirts',
        'kids_shoes', 'kids_pants', 'kids_shirts'
    ];

    if (in_array($category, $allowedCategories)) {

        $column = $category . "_id";
        $sql = "INSERT INTO favoriteproduct ($column) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }

        $stmt->close();
    } else {
        echo "invalid_category";
    }
} else {
    echo "invalid_data";
}

$conn->close();
?>
