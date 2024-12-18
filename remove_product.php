<?php
header('Content-Type: application/json');

include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['favorite_id'])) {
        $favorite_id = intval($_POST['favorite_id']);
        
        $delete_sql = "DELETE FROM favoriteproduct WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param('i', $favorite_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Product removed successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to remove product']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid product ID']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
