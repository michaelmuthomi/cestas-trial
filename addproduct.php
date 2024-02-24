<?php
// Include the database connection file
include 'dbcon.php';

// Define variables to hold form input values
$name = $oldPrice = $newPrice = $type = $image = '';
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $name = $_POST['name'];
  $oldPrice = $_POST['old_price'];
  $newPrice = $_POST['new_price'];
  $type = $_POST['type'];

  // Check if all required fields are filled
  if (empty($name) || empty($oldPrice) || empty($newPrice) || empty($type)) {
    $error = 'Please fill in all the required fields.';
  } else {
    // Handle the uploaded image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $imageTmpName = $_FILES['image']['tmp_name'];
      $imageFileName = $_FILES['image']['name'];
      $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));

      // Check if the uploaded file is an image
      $allowedExtensions = array('jpg', 'jpeg', 'png');
      if (in_array($imageFileType, $allowedExtensions)) {
        // Generate a unique filename for the image
        $uniqueFilename = uniqid('product_') . '.' . $imageFileType;
        $imageDestination = 'images/' . $uniqueFilename;

        // Move the uploaded image to the destination folder
        if (move_uploaded_file($imageTmpName, $imageDestination)) {
          // Insert the product details into the database
          $query = "INSERT INTO products (name, newprice, oldprice, image, type) VALUES ('$name', $newPrice, $oldPrice, '$uniqueFilename', '$type')";
          $result = mysqli_query($dbconn, $query);

          if ($result) {
            // Redirect to the page indicating that the product is successfully added
            header("Location: admin.php");
            exit();
          } else {
            $error = 'Failed to add the product. Please try again.';
          }
        } else {
          $error = 'Failed to move the uploaded image. Please try again.';
        }
      } else {
        $error = 'Only JPG, JPEG, and PNG files are allowed for the product image.';
      }
    } else {
      $error = 'Please upload a product image.';
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
</head>
<body>
<?php include('header.php'); ?>

<?php
include 'dbcon.php';
?>

<style>
  .box-container {
    display: flex;
    flex-wrap: wrap;
  }

  .box {
    width: calc(33.33% - 20px);
    margin: 10px;
  }

  body {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 14px;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th {
    background-color: black;
    color: white;
    text-align: left;
    padding: 8px;
  }

  td {
    border-bottom: 1px solid #ddd;
    padding: 8px;
  }
</style>
<style>
  /* ...existing CSS code... */

  body {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 14px;
  }

  .form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px; /* Adjust the margin as needed */
  }

  /* ...existing CSS code... */
</style>
<style>
  /* ...existing CSS code... */

  form {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
  }

  form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
  }

  form input[type="text"],
  form input[type="number"],
  form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }

  form input[type="submit"] {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }

  form input[type="submit"]:hover {
    background-color: #45a049;
  }

  /* ...existing CSS code... */
</style>


<body>
  <!--header section starts-->
  <header>
    <div class="header-1">
      <a href="#" style="" class="logo"><i class="fa-solid fa-basket-shopping"></i></i>Cesta- Admin Panel</a>
      
    </div>
    <!--header 2-->

    <div class="header-2 " style="width: 1360px;">

      <div id="menu-bar" class="fa-sharp fa-solid fa-bars"></div>
      <nav class="navbar">
        <a href="admin.php" style="" class="nav-link active">Dashboard</a>
        <a href="addproduct.php" style="" class="nav-link active">Add Products</a>
        <a href="orders.php" style="" class="nav-link active">No of orders</a>
        <a href="index.php" style="" class="nav-link active">Home</a>
      </nav>

      <div class="icons">
        <a href="cart.php" class="fa-sharp fa-solid fa-cart-shopping">
          <?php
          $countSql = "SELECT COUNT(*) AS total_items FROM cart";
          $results = mysqli_query($dbconn, $countSql);

          $rows = mysqli_fetch_assoc($results);
          $totalItems = $rows['total_items'];
          echo '<span style="color: #2c2c54;   font-size: 15px; margin-top: 50px; border-radius: 50%;">' . $totalItems . '</span>';
          ?>
        </a>
        <?php
                session_start();
                if (isset($_SESSION['loggedIn'])) {

                } else {

                    echo '<a href="signup.php" class="fa-sharp fa-solid fa-circle-user"></a>';
                }
                ?>
      </div>
    </div>

  </header>
  <!--header section ends-->
  

  <?php if (!empty($error)) {
    echo '<p style="color: red;">' . $error . '</p>';
  } ?>

  <form method="POST" enctype="multipart/form-data" style="">
  <h2>Add Product</h2>
    <div>
      <label for="name">Product Name:</label>
      <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
    </div>
    <div>
      <label for="old_price">Old Price:</label>
      <input type="number" id="old_price" name="old_price" value="<?php echo $oldPrice; ?>" required>
    </div>
    <div>
      <label for="new_price">New Price:</label>
      <input type="number" id="new_price" name="new_price" value="<?php echo $newPrice; ?>" required>
    </div>
    <div>
  <label for="type">Type:</label>
  <select id="type" name="type" required>
    <option value="">Select Type</option>
    <option value="fruit"<?php if ($type === 'fruit') echo ' selected'; ?>>Fruit</option>
    <option value="vegetable"<?php if ($type === 'vegetable') echo ' selected'; ?>>Vegetable</option>
    <option value="milk"<?php if ($type === 'milk') echo ' selected'; ?>>Milk</option>
  </select>
</div>
    <div>
      <label for="image">Product Image:</label>
      <input type="file" id="image" name="image" required>
    </div>
    <div>
      <input type="submit" value="Add Product">
    </div>
  </form>
</body>
</html>
