<?php 

include "conn.php";

function getCartCount() {
  global $conn; 
  if (!$conn) {
    die('Database connection not initialized.');
  }

  $query = "SELECT COUNT(*) AS count FROM favoriteproduct";
  $result = $conn->query($query);

  if ($result) {
    $row = $result->fetch_assoc();
    return $row['count'];
  }
  return 0; 
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  echo json_encode(['count' => getCartCount()]);
  exit;
}
?>
