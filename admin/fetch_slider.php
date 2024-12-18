<?php
include "conn.php";

$query = "SELECT id, cover_image, status FROM slider";
$result = mysqli_query($conn, $query);

$sliders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $sliders[] = $row;
}

header('Content-Type: application/json');
echo json_encode($sliders);

mysqli_close($conn);
?>
