<?php
// Include the database connection file
include 'dbcon.php';

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Update the "shipped" column value in the database
  $query = "UPDATE orders SET shipped = 'no' WHERE id = '$id'";
  $result = mysqli_query($dbconn, $query);

  if ($result) {
    // Redirect to the page indicating that the value is successfully updated
    header("Location: orders.php");
    exit();
  } else {
    // Error occurred during the update
    $error = "Failed to update the value. Please try again.";
  }
} else {
  // Redirect to a page indicating that the product ID is missing
  header("Location: notfound.php");
  exit();
}
?>
