<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кошница</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="display: flex; flex-wrap: wrap; max-width: 1200px; margin: 20px auto; gap: 20px;">
        <div style="flex: 1 1 calc(60% - 20px); background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); min-width: 300px;">
            <h2 style="margin-top: 0; color: #333;">Любими продукти</h2>
            <p style="font-size: 14px; color: #555; margin-bottom: 20px;">Добавете своите любими продукти, за да ги разгледате по-късно.</p>

            <?php
            include "pages/database/conn.php";
   
            $categories = [
                'men_shoes' => ['table' => 'men_shoes_products', 'column' => 'men_shoes_id'],
                'men_pants' => ['table' => 'men_pants_products', 'column' => 'men_pants_id'],
                'men_shirts' => ['table' => 'men_shirts_products', 'column' => 'men_shirts_id'],
                'women_shoes' => ['table' => 'women_shoes_products', 'column' => 'women_shoes_id'],
                'women_pants' => ['table' => 'women_pants_products', 'column' => 'women_pants_id'],
                'women_shirts' => ['table' => 'women_shirts_products', 'column' => 'women_shirts_id'],
                'kids_shoes' => ['table' => 'kids_shoes_products', 'column' => 'kids_shoes_id'],
                'kids_pants' => ['table' => 'kids_pants_products', 'column' => 'kids_pants_id'],
                'kids_shirts' => ['table' => 'kids_shirts_products', 'column' => 'kids_shirts_id'],
            ];

            $foundProducts = false;
            $totalPrice = 0; 

          
            if (isset($_GET['remove_id'])) {
                $remove_id = $_GET['remove_id'];
                $remove_category = $_GET['category'];

                $remove_sql = "DELETE FROM favoriteproduct WHERE id = ?";
                $stmt = $conn->prepare($remove_sql);
                $stmt->bind_param('i', $remove_id);
                $stmt->execute();
                $stmt->close();
            }

            foreach ($categories as $category => $data) {
                $sql = "
                    SELECT p.*, f.id AS favorite_id
                    FROM {$data['table']} p
                    JOIN favoriteproduct f ON p.id = f.{$data['column']}
                ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $foundProducts = true;
                
                    $imageDirectory = '';
                    switch ($category) {
                        case 'women_shoes':
                        case 'women_pants':
                        case 'women_shirts':
                            $imageDirectory = 'women/images/albums/';
                            break;
                        case 'men_shoes':
                        case 'men_pants':
                        case 'men_shirts':
                            $imageDirectory = 'mens/images/albums/';
                            break;
                        case 'kids_shoes':
                        case 'kids_pants':
                        case 'kids_shirts':
                            $imageDirectory = 'kids/images/albums/';
                            break;
                        default:
                            $imageDirectory = 'default/images/albums/'; 
                            break;
                    }
  
                    while ($row = $result->fetch_assoc()) {
                        $imagePath = 'admin/content/' . $imageDirectory . $row['image'];
                        $totalPrice += $row['price']; 

                        echo "<div style='display: flex; flex-wrap: wrap; gap: 20px; border-bottom: 1px solid #eaeaea; padding-bottom: 20px; align-items: center;'>";
                        echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row['product_name']) . "' style='width: 150px; height: 180px; object-fit: cover; border-radius: 8px;'>";
                        echo "<div style='flex: 1 1 auto; min-width: 150px;'>";
                        echo "<h3 style='margin: 0; font-size: 18px; color: #333;'>" . htmlspecialchars($row['product_name']) . "</h3>";
                        echo "</div>";
                        echo "<div style='margin-left: auto; text-align: right;'>";
                        echo "<p style='font-size: 18px; font-weight: bold; color: #e60000;'>" . htmlspecialchars($row['price']) . " лв</p>";
                        echo "<a href='#' class='remove-product' data-favorite-id='" . htmlspecialchars($row['favorite_id']) . "' style='color: #e60000; font-size: 14px; text-decoration: none;'>Премахни</a>";

                        echo "</div>";
                        echo "</div>";
                    }
                }
            }

            if (!$foundProducts) {
                echo "<p>Няма добавени любими продукти.</p>";
            }

            $conn->close();
            ?>
        </div>

        <div style="flex: 1 1 calc(40% - 20px); background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); min-width: 300px;">
            <h2 style="margin-top: 0; color: #333;">Обобщение</h2>
            <p id="total-price" style="display: flex; justify-content: space-between; margin: 10px 0; font-size: 14px;">Стойност на продуктите <span><?php echo number_format($totalPrice, 2); ?> лв</span></p>
            <p style="display: flex; justify-content: space-between; margin: 10px 0; font-size: 14px;">Доставка <span>Изберете доставка и плащане</span></p>
            <p style="font-size: 18px; font-weight: bold;">За заплащане (с ДДС) <span><?php echo number_format($totalPrice, 2); ?> лв</span></p>
            <button onclick="window.location.href = '?page=payment/payment';" 
        style="background: #28a745; color: white; border: none; padding: 15px; width: 100%; border-radius: 5px; font-size: 16px; cursor: pointer;">
    Към касата
</button>

            <p style="font-size: 12px; color: #777; margin-top: 10px;">Доставка от 0 лв. и безплатно връщане с куриерска фирма ЕКОНТ</p>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
         
            const removeLinks = document.querySelectorAll('.remove-product');

            removeLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); 

                    const favoriteId = this.getAttribute('data-favorite-id'); 
                    const productElement = this.closest('.product-item'); 

                    if (confirm('Сигурни ли сте, че искате да премахнете този продукт от любими?')) {
                      
                        fetch('remove_product.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `favorite_id=${favoriteId}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert('Продуктът беше премахнат успешно!');
                                location.reload(); 
                            } else {
                                alert('Грешка: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Грешка при изтриването на продукта.');
                        });
                    }
                });
            });
        });

    </script>


</body>
</html>
