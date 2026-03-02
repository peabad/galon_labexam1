<?php
include "../db.php";
$id = $_GET['id'];
$id = mysqli_real_escape_string($conn, $id);

$sql = "DELETE FROM students WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  echo "<div class='alert alert-success'>Record deleted successfully</div>";
  header("Location: index.php");
  exit();
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>