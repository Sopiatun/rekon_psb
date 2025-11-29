<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fields = $_POST;
  $cols = implode(", ", array_keys($fields));
  $vals = "'" . implode("','", array_map([$conn, 'real_escape_string'], $fields)) . "'";
  $sql = "INSERT INTO rekons ($cols) VALUES ($vals)";
  
  if ($conn->query($sql)) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='rekon_psb.php';</script>";
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
