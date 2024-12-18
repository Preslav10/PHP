<?php

include "pages/database/conn.php";

$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;

if ($productId) {
    $sql = "
        SELECT p.id, p.product_name, p.price, p.image, ph.photo_path 
        FROM kids_shoes_products p
        LEFT JOIN kids_shoes_photos ph ON p.id = ph.product_id
        WHERE p.id = ? 
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Продуктът не съществува.";
    }
} else {
    echo "Няма подадено валидно ID на продукта.";
}

$conn->close();

$coverImageDirectory = 'admin/content/kids/images/albums/';
$galleryImageDirectory = 'admin/content/kids/images/photos/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .product-details {
            display: flex;
            flex-wrap: wrap;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 1200px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .product-image img {
            border-radius: 8px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
  
    <div class="product-details">
        <div class="product-image" style="flex: 1;">
            <a href="<?php echo $coverImageDirectory . htmlspecialchars($product['image']); ?>" data-fancybox="gallery">
                <img src="<?php echo $coverImageDirectory . htmlspecialchars($product['image']); ?>" alt="Cover Image" style="width:100%; height:auto;">
            </a>
            <?php if ($product['photo_path']): ?>
                <a href="<?php echo $galleryImageDirectory . htmlspecialchars($product['photo_path']); ?>" data-fancybox="gallery" >
                    <img src="<?php echo $galleryImageDirectory . htmlspecialchars($product['photo_path']); ?>" alt="Gallery Image" style="width:200px; height:auto; margin-top: 20px;">
                </a>
            <?php endif; ?>
        </div>
        <div style="flex: 1; padding-left: 20px;">
            <h1 style="font-size: 24px; font-weight: bold;">
                <?php echo htmlspecialchars($product['product_name']); ?>
            </h1>
            <p style="font-size: 20px; color: #333; margin: 10px 0;">
                <?php echo htmlspecialchars($product['price']); ?> лв.
            </p>
            <div style="display: flex; gap: 10px; ">
                <div style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; text-align: center;">28</div>
                <div style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; text-align: center;">30</div>
                <div style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; text-align: center;">32</div>
                <div style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; text-align: center;">34</div>
            </div>
            <p style="font-size: 14px; color: #666;">Изберете правилния размер.</p>
             
             <button type="button" id="addToFavoritesButton" style="background-color: #f59e0b; color: white; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Добави в любими</button>
            
            <a href="?page=kids_shoes/4" style="display: inline-block; margin-top: 20px; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; text-align: center; cursor: pointer;">
                Върни се към обувките
            </a>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#addToFavoritesButton').click(function () {
                const productId = <?php echo json_encode($productId); ?>;
                const category = 'kids_shoes';

                $.ajax({
                    url: 'add_to_favorites.php',
                    type: 'POST',
                    data: {
                        product_id: productId,
                        category: category
                    },
                    success: function (response) {
                        if (response.trim() === "success") {
                            alert('Продуктът е добавен в любими!');
                        } else {
                            alert('Грешка: ' + response);
                        }
                    },
                    error: function () {
                        alert('Възникна грешка при добавянето в любими.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("[data-fancybox]").fancybox({
                loop: true,
                buttons: ["zoom", "close"]
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</body>
</html>
