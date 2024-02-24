<?php
// Include the database connection file
include 'dbcon.php';

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Delete the product from the database
  $query = "DELETE FROM products WHERE id = '$id'";
  $result = mysqli_query($dbconn, $query);

  if ($result) {
    // Redirect to the page indicating that the product is successfully deleted
    header("Location: admin.php");
    exit();
  } else {
    // Error occurred during the deletion
    $error = "Failed to delete the product. Please try again.";
  }
} else {
  // Redirect to a page indicating that the product ID is missing
  header("Location: notfound.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Product</title>
</head>
<body>
  <h2>Delete Product</h2>

  <?php if (isset($error)) {
    echo '<p style="color: red;">' . $error . '</p>';
  } ?>

  <p>Are you sure you want to delete this product?</p>

  <form method="POST">
    <input type="submit" value="Delete">
  </form>
</body>
</html>
