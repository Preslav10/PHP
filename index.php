<?php

$page = $_GET['page'] ?? 'home'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>

    <?php include "header.php"; ?>


 
        <?php
        
        $pagePath = './pages/' . $page . '.php';

   
        if (file_exists($pagePath)) {
            require_once($pagePath); 
        } else {
           
            echo '<p class="text-red-500 text-center">Страницата не е намерена!</p>';
        }
        ?>
    

    <?php include "footer.php"; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>
