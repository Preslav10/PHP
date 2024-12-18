<?php

include "pages/database/conn.php";

$minPrice = isset($_POST['min_price']) ? (float)$_POST['min_price'] : 13;
$maxPrice = isset($_POST['max_price']) ? (float)$_POST['max_price'] : 1345;

$query = "SELECT * FROM women_shirts_products WHERE price BETWEEN $minPrice AND $maxPrice";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Down и Range меню</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color: #f7fafc;">
    <div style="display: flex; flex-direction: row; align-items: flex-start; gap: 20px; padding: 20px;">
        <div style="width: 20%; min-height: 600px; background-color: #2d3748; color: white; display: flex; flex-direction: column; padding: 20px;">           
            <p class="menu-item">Всички Продукти</p>
            <a href="#" class="menu-item">Дънки</a>
            <a href="#" class="menu-item">Тениски</a>
            <a href="#" class="menu-item"></a>
        </div>

        <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 20px; width: 100%;">
            <form method="POST" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap; width: 100%;">
                    <div class="dropdown" style="position: relative; min-width: 150px; flex: 1; flex-basis: 30%; max-width: 100%;">
                        <select id="brand-filter" style=" padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 12px; background-color: #fff; min-width: 100%;">
                            <option value="" disabled selected>Размер</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                        </select>
                    </div>

                    <div class="dropdown" style="position: relative; min-width: 150px; flex: 1;flex-basis: 30%; max-width: 100%;">
                        <select id="brand-filter" style=" padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 12px; background-color: #fff; min-width: 100%;">
                            <option value="" disabled selected>Марка</option>
                            <option value="Nike">Nike</option>
                            <option value="Adidas">Adidas</option>
                            <option value="Puma">Puma</option>
                        </select>
                    </div>

                    <div class="dropdown" style="position: relative; min-width: 150px; flex: 1; flex-basis: 30%; max-width: 100%;">
                        <button type="button" style=" background-color: #fff; color: #333; border: 1px solid #ccc; padding: 8px; width: 100%; text-align: left; font-size: 12px; border-radius: 4px;  cursor: pointer;">Цена</button>
                        <div style="display: none; position: absolute; top: 40px; left: 0; background-color: #fff; border: 1px solid #ccc; border-radius: 8px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 10px; z-index: 10;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <input type="number" name="min_price" id="price-min" placeholder="13 лв." value="<?php echo $minPrice; ?>" style=" width: 40%; padding: 5px; border: 1px solid #ccc; border-radius: 4px; text-align: center; font-size: 12px;">
                                <span style="font-size: 14px; color: #333;"> - </span>
                                <input type="number" name="max_price" id="price-max" placeholder="1345 лв." value="<?php echo $maxPrice; ?>" style=" width: 40%; padding: 5px; border: 1px solid #ccc; border-radius: 4px; text-align: center; font-size: 12px;">
                            </div>
                            <button type="submit" style="background: #4caf50; color: white; border: none; padding: 8px; border-radius: 4px; cursor: pointer; font-size: 12px; width: 100%;">Филтрирай</button>
                        </div>
                    </div>

                    <button id="clear-filters" style="background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-size: 12px; ">
                        Изчисти филтрите
                    </button>
                </div>
            </form>

            <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $productName = $row['product_name']; 
                        $productPrice = $row['price'];
                        $productImage = $row['image'];
                        $productId = $row['id']; 
                ?>
                    <div style="width: 100%; max-width: 300px; background: white; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; text-align: center;">
                        <a href="?page=content/18&id=<?php echo $productId; ?>" style="display: block;">
                            <img src="admin/content/women/images/albums/<?php echo $productImage; ?>" alt="product image" style="width: 100%; height: auto; transition: transform 0.3s;">
                        </a>
                        <div style="padding: 10px;">
                            <a href="?page=content/18&id=<?php echo $productId; ?>" style="text-decoration: none; color: #333;">
                                <h5 style="font-size: 16px; font-weight: bold; margin: 10px 0;">
                                    <?php echo $productName; ?>
                                </h5>
                            </a>
                            <span style="font-size: 18px; font-weight: bold; color: #333; display: block; margin-bottom: 10px;">
                                <?php echo number_format($productPrice, 2); ?> лв.
                            </span>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<p>Няма продукти в базата данни.</p>";
                }
                ?>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".dropdown button").click(function () {
                const menu = $(this).siblings("div");
                menu.toggle();
            });
        });
    </script>
</body>
</html>

<?php
