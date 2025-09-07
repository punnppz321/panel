<?php

include('conn.php');

$sql1 = "SELECT * FROM files WHERE id=0";
$result1 = mysqli_query($conn, $sql1);

if ($result1) {
  $files = mysqli_fetch_assoc($result1);
  $updateData = [
    'version' => $files['version'],
    'downloadUrl' => "http://nonomod.freewebhostmost.com/update/" . $files['name'], 
    'libname' => $files['name'],
    'releaseNotes' => 'Bug fixes and performance improvements',
  ];

  // ส่ง response เป็น JSON
  header('Content-Type: application/json');
  echo json_encode($updateData);
} else {
  // Handle error กรณี query ไม่สำเร็จ
  http_response_code(500); 
  echo json_encode(['error' => 'Database error']); 
}

?>