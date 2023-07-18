<?php
// Include the database connection file
include 'dbcon.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the submitted form data
  $id = $_POST['id'];
  $name = $_POST['name'];
  $newprice = $_POST['newprice'];
  $oldprice = $_POST['oldprice'];
  $type = $_POST['type'];

  // Update the product in the database
  $query = "UPDATE products SET name = '$name', newprice = '$newprice', oldprice = '$oldprice', type = '$type' WHERE id = '$id'";
  $result = mysqli_query($dbconn, $query);

  if ($result) {
    // Redirect to the page displaying the updated product
    header("Location: admin.php");
    exit();
  } else {
    // Error occurred during the update
    $error = "Failed to update the product. Please try again.";
  }
} else {
  // Check if the product ID is provided in the URL
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the product from the database
    $query = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($dbconn, $query);
    $product = mysqli_fetch_assoc($result);

    // Check if the product exists
    if (!$product) {
      // Redirect to a page indicating that the product does not exist
      header("Location: notfound.php");
      exit();
    }
  } else {
    // Redirect to a page indicating that the product ID is missing
    header("Location: notfound.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product</title>
  <style>
    label {
      display: block;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <h2>Edit Product</h2>

  <?php if (isset($error)) {
    echo '<p style="color: red;">' . $error . '</p>';
  } ?>

  <form method="POST">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <label>
      Name:
      <input type="text" name="name" value="<?php echo $product['name']; ?>">
    </label>
    <label>
      New Price:
      <input type="number" name="newprice" value="<?php echo $product['newprice']; ?>">
    </label>
    <label>
      Old Price:
      <input type="number" name="oldprice" value="<?php echo $product['oldprice']; ?>">
    </label>
    <label>
      Type:
      <input type="text" name="type" value="<?php echo $product['type']; ?>">
    </label>
    <input type="submit" value="Update">
  </form>
</body>
</html>
