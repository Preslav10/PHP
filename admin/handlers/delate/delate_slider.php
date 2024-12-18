<?php

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];


$query = "DELETE FROM slider WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);

$response = [];
if (mysqli_stmt_execute($stmt)) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = mysqli_error($conn);
}

echo json_encode($response);
mysqli_close($conn);
?>
