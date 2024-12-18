<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ad_id']) || $_SESSION['ad_id'] == '') {
    header('location:login.php'); 
    exit();  
}

include('conn.php');  

$ad_id = $_SESSION['ad_id'];

try {

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE ad_id = :ad_id");
    $stmt->execute(['ad_id' => $ad_id]); 

   
    if ($stmt->rowCount() > 0) {

        $user = $stmt->fetch();  
        $user_role = $user['ad_id']; 
        $user_email = $user['ad_email'];  
        $user_name = $user['ad_name'];  
    } else {
     
        session_destroy();
        header('location:login.php');
        exit();  
    }
} catch (PDOException $e) {

    echo 'Error: ' . $e->getMessage();
    exit();
}

?>
