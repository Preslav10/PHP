<?php
include "pages/database/conn.php";

$sql = "SELECT cover_image FROM slider";
$result = $conn->query($sql);

$menShirtsQuery = "SELECT * FROM men_shirts_products LIMIT 8";
$menShirtsResult = $conn->query($menShirtsQuery);

// Заявка за мъжки панталони
$menPantsQuery = "SELECT * FROM men_pants_products LIMIT 8";
$menPantsResult = $conn->query($menPantsQuery);

// Заявка за мъжки обувки
$menShoesQuery = "SELECT * FROM men_shoes_products LIMIT 8";
$menShoesResult = $conn->query($menShoesQuery);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Carousel</title>
</head>
<body style="background-color: #f7fafc;">
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <div class="relative  h-80 overflow-hidden rounded-lg md:h-[520px]">
            <?php
            if ($result->num_rows > 0) {
                $index = 0; 
                while($row = $result->fetch_assoc()) {
                    $imagePath = "admin/content/slider/images/slideralbums/" . $row['cover_image'];
                    ?>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="<?php echo $imagePath; ?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <?php
                    $index++;
                }
            } else {
                echo "Няма налични изображения.";
            }
            ?>
        </div>

        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <?php
            $result->data_seek(0); 
            $index = 0;
            while ($row = $result->fetch_assoc()) {
                ?>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide <?php echo $index + 1; ?>" data-carousel-slide-to="<?php echo $index; ?>"></button>
                <?php
                $index++;
            }
            ?>
        </div>

     
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

            <div class="flex items-center justify-center min-h-screen bg-gray-100">
                <a class="flex flex-col items-center bg-green-900 border border-gray-200 rounded-lg md:flex-row w-full max-w-[82rem] dark:border-gray-700 dark:bg-gray-800">
                    <img src="images/images3.png" class="object-cover w-full rounded-t-lg h-80 md:h-[600px] md:w-[50%] md:rounded-none md:rounded-s-lg">
                    <div class="flex flex-col justify-between p-8 leading-normal w-full md:w-[50%]">
                        <p class="mb-3 font-bold text-white">ВЕЧЕН ПОДАРЪК</p>
                        <h5 class="mb-2 text-4xl font-bold tracking-tight text-white">Levis</h5>
                    </div>
                </a>
            </div>

           
      
            <div style="display: flex; justify-content: flex-start; flex-wrap: wrap; gap: 20px; margin-left: 20px">
                <?php
                if ($menShirtsResult->num_rows > 0) {
                    while ($row = $menShirtsResult->fetch_assoc()) {
                        $productName = $row['product_name']; 
                        $productPrice = $row['price'];
                        $productImage = $row['image'];
                        $productId = $row['id']; 
                ?>
                    <div style="flex: 1 1 calc(25% - 20px); max-width: calc(25% - 20px); border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; text-align: center;">
                        <a href="?page=content/15&id=<?php echo $productId; ?>" style="display: block;">
                            <img src="admin/content/mens/images/albums/<?php echo $productImage; ?>" alt="product image" style="width: 100%; height: auto; transition: transform 0.3s;">
                        </a>
                        <div style="padding: 10px;">
                            <a href="?page=content/15&id=<?php echo $productId; ?>" style="text-decoration: none; color: #333;">
                                <h5 style="font-size: 16px; font-weight: bold; margin: 10px 0;"><?php echo $productName; ?></h5>
                            </a>
                            <span style="font-size: 18px; font-weight: bold; color: #333; display: block; margin-bottom: 10px;">
                                <?php echo number_format($productPrice, 2); ?> лв.
                            </span>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<p>Няма продукти в категорията 'Мъжки ризи'.</p>";
                }
                ?>
            </div>


            <div class="flex items-center justify-center min-h-screen bg-gray-100">
                <a class="flex flex-col items-center bg-gray-800 border border-gray-200 rounded-lg md:flex-row w-full max-w-[82rem] dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex flex-col justify-between p-8 leading-normal w-full md:w-[50%] ">
                        <p class="mb-3  pl-8 font-bold text-white">Oscar S.</p>
                        <h5 class="mb-2 pl-8 text-4xl font-bold tracking-tight text-white">Black Leather Coat Look</h5>
                    </div>
                    <img src="images/image1.png" class="object-cover w-full rounded-t-lg h-80 md:h-[600px] md:w-[50%] md:rounded-none md:rounded-e-lg">
                </a>
            </div>

                
        <div style="display: flex; justify-content: flex-start; flex-wrap: wrap; gap: 20px; margin-left: 20px">
            <?php
            if ($menPantsResult->num_rows > 0) {
                while ($row = $menPantsResult->fetch_assoc()) {
                    $productName = $row['product_name']; 
                    $productPrice = $row['price'];
                    $productImage = $row['image'];
                    $productId = $row['id']; 
            ?>
                <div style="flex: 1 1 calc(25% - 20px); max-width: calc(25% - 20px); border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; text-align: center;">
                    <a href="?page=content/14&id=<?php echo $productId; ?>" style="display: block;">
                        <img src="admin/content/mens/images/albums/<?php echo $productImage; ?>" alt="product image" style="width: 100%; height: auto; transition: transform 0.3s;">
                    </a>
                    <div style="padding: 10px;">
                        <a href="?page=content/14&id=<?php echo $productId; ?>" style="text-decoration: none; color: #333;">
                            <h5 style="font-size: 16px; font-weight: bold; margin: 10px 0;"><?php echo $productName; ?></h5>
                        </a>
                        <span style="font-size: 18px; font-weight: bold; color: #333; display: block; margin-bottom: 10px;">
                            <?php echo number_format($productPrice, 2); ?> лв.
                        </span>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<p>Няма продукти в категорията 'Мъжки панталони'.</p>";
            }
            ?>
        </div>
    
        
            <div class="flex items-center justify-center min-h-screen bg-gray-100">
                <a class="flex flex-col items-center bg-red-800 border border-gray-200 rounded-lg md:flex-row w-full max-w-[82rem] dark:border-gray-700 dark:bg-gray-800">
                    <img src="images/image2.jpg" class="object-cover w-full rounded-t-lg h-80 md:h-[600px] md:w-[50%] md:rounded-none md:rounded-s-lg">
                    <div class="flex flex-col justify-between p-8 leading-normal w-full md:w-[50%]">
                        <h5 class="mb-2 text-4xl font-bold tracking-tight text-white">Night Apparel: страхотни рокли</h5>
                    </div>
                </a>
            </div>

                <div style="display: flex; justify-content: flex-start; flex-wrap: wrap; gap: 20px; margin-left: 20px">
                    <?php
                    if ($menShoesResult->num_rows > 0) {
                        while ($row = $menShoesResult->fetch_assoc()) {
                            $productName = $row['product_name']; 
                            $productPrice = $row['price'];
                            $productImage = $row['image'];
                            $productId = $row['id']; 
                    ?>
                        <div style="flex: 1 1 calc(25% - 20px); max-width: calc(25% - 20px); border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; text-align: center;">
                            <a href="?page=content/13&id=<?php echo $productId; ?>" style="display: block;">
                                <img src="admin/content/mens/images/albums/<?php echo $productImage; ?>" alt="product image" style="width: 100%; height: auto; transition: transform 0.3s;">
                            </a>
                            <div style="padding: 10px;">
                                <a href="?page=content/13&id=<?php echo $productId; ?>" style="text-decoration: none; color: #333;">
                                    <h5 style="font-size: 16px; font-weight: bold; margin: 10px 0;"><?php echo $productName; ?></h5>
                                </a>
                                <span style="font-size: 18px; font-weight: bold; color: #333; display: block; margin-bottom: 10px;">
                                    <?php echo number_format($productPrice, 2); ?> лв.
                                </span>
                            </div>
                        </div>
                    <?php
                        }
                    } else {
                        echo "<p>Няма продукти в категорията 'Мъжки обувки'.</p>";
                    }
                    ?>
              </div>
            </div>  
              
    
    <button id="scrollToTopBtn" class="fixed bottom-5 right-5 w-12 h-12 bg-blue-800 rounded-lg shadow-lg flex items-center justify-center cursor-pointer hover:bg-blue-700 focus:outline-none transition-transform transform hover:scale-105">
        <img src="images/222.png" alt="Scroll to Top" class="w-8 h-8" />
    </button>
    <style>
        #scrollToTopBtn {
            display: none;
        }
    </style>
    <script>
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollToTopBtn.style.display = 'flex'; 
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

</body>
</html>
