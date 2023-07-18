<?php include ('header.php')?>
<?php include ('dbcon.php')?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <!--header section starts-->
  <header>
    <div class="header-1">
      <a href="#" style="" class="logo"><i class="fa-solid fa-basket-shopping"></i></i>Cesta- Cart</a>
      <form action="" class="search-box-container">

      </form>
    </div>
    <!--header 2-->

    <div class="header-2 " style="width: 1360px;">

      <div id="menu-bar" class="fa-sharp fa-solid fa-bars"></div>
      <nav class="navbar">
      <a href="index.php" style="" class="nav-link active">Home</a>
                <a href="#category" style="" class="nav-link active">Category</a>
                <a href="#product" style="" class="nav-link active">Product</a>
                <a href="contactus.php" style="" class="nav-link active">Contact</a>
                <a href="admin.php" style="" class="nav-link active">Admin</a>
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
        <a href="signup.php" class="fa-sharp fa-solid fa-circle-user"></a>
      </div>
    </div>

  </header>
  <!--header section ends-->
<link rel="stylesheet" href="style.css">
    <section class="product" id="product">
<!--header section starts-->

    <!--header section ends-->
    <h1 class="heading" >Added To <span >Cart</span></h1>

    <div class="box-container">
    <?php
    // Assuming you have a database connection established
    include 'dbcon.php';

    // Check if the add to cart button is clicked
    if (isset($_POST['add_to_cart'])) {
        $productName = $_POST['product_name'];
        $productQuantity = $_POST['product_quantity'];
        $productPrice = $_POST['product_price'];
        $productImage = $_POST['product_image'];

        // Insert the product details into the cart table
        $insertSql = "INSERT INTO cart (name, quantity, price, image) VALUES ('$productName', '$productQuantity', '$productPrice', '$productImage')";
        mysqli_query($dbconn, $insertSql);

        // Provide feedback to the user
        echo "<script>alert('Product added to cart.')</script>";
    }

    // Check if the remove from cart button is clicked
    if (isset($_POST['remove_from_cart'])) {
        $productName = $_POST['product_name'];

        // Remove the product from the cart table
        $removeSql = "DELETE FROM cart WHERE name = '$productName'";
        mysqli_query($dbconn, $removeSql);

        // Provide feedback to the user
        echo "<script>alert('Order Succesfull')</script>";
    }


// Assuming you have a database connection established
include 'dbcon.php';

// Check if the add to cart button is clicked
if (isset($_POST['add_to_cart'])) {
    $productName = $_POST['product_name'];
    $productQuantity = $_POST['product_quantity'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];

    // Insert the product details into the cart table
    $insertSql = "INSERT INTO cart (name, quantity, price, image) VALUES ('$productName', '$productQuantity', '$productPrice', '$productImage')";
    mysqli_query($dbconn, $insertSql);

    // Provide feedback to the user
    echo "<script>alert('Product added to cart.')</script>";
}

// Check if the remove from cart button is clicked
if (isset($_POST['remove_from_cart'])) {
    $productName = $_POST['product_name'];

    // Remove the product from the cart table
    $removeSql = "DELETE FROM cart WHERE name = '$productName'";
    mysqli_query($dbconn, $removeSql);

    // Provide feedback to the user
    echo "<script>alert('Order Successful')</script>";
}

// Query to retrieve products from the database
$sql = "SELECT * FROM cart";
$result = mysqli_query($dbconn, $sql);

// Check if there are any products
if (mysqli_num_rows($result) > 0) {
    $totalPrice = 0; // Variable to store the total price

    while ($row = mysqli_fetch_assoc($result)) {
        $productName = $row['name'];
        $productImage = $row['image'];
        $productPrice = $row['price'];
        $productQuantity = $row['quantity'];
        

        $_SESSION['name'] = $productName;
        $_SESSION['price'] = $productPrice;
        $_SESSION['quantity'] = $productQuantity;
        $_SESSION['image'] = $productImage;

        // Increment the total price
        $totalPrice += $productPrice * $productQuantity;
        $productTotalPrice = $productPrice * $productQuantity;

        // Generate HTML code for each product
        echo '<div class="box">
        <span class="discount">-30%</span>
        
        <img src="images/' . $productImage . '" alt="">
        <h3>' . $productName . '</h3>
        
        <div class="price">Ksh <span style="text-decoration: none; color: black; font-size: 2rem;" id="productPrice_' . $productName . '">' . $productTotalPrice . '</span></div>

        <form method="POST" action="./mpesa/index.php">
            <input type="hidden" name="product_name" value="' . $productName . '">
            <input type="hidden" name="product_price" id="productPriceInput_' . $productName . '" value="' . $productPrice * $productQuantity . '">
            <input type="hidden" name="product_image" value="' . $productImage . '">
            <div class="quantity">
                <span>Quantity:</span>
                <input type="number" min="1" max="1000" name="product_quantity" id="productQuantityInput_' . $productName . '" value="' . $productQuantity . '" onchange="updateProductPrice(\'' . $productName . '\')">
                <span>/kg</span>
            </div>
            <div class="button-container">
                <button type="submit" style="width: display: block; margin: 0 auto;" name="remove_from_cart" class="btn">Buy Now</button>
            </div>
        </form>
    </div>';

    }

    // Display total price and "Buy Now" button
    echo '<form method="POST" action="./mpesa/index.php">';
    echo '<input type="hidden" name="total_price" value="' . $totalPrice . '">';
    echo '<button type="submit" name="buy_now" class="btn">Total: ' . $totalPrice . ' Buy All</button>';
    echo '</form>';
} else {
    echo "<script>alert('No More products Found.')</script>";
}
?>

</div>
<script>
  function updateProductPrice(productName) {
    // Get the quantity and product price elements
    var quantityInput = document.getElementById("productQuantityInput_" + productName);
    var priceElement = document.getElementById("productPrice_" + productName);
    var priceInput = document.getElementById("productPriceInput_" + productName);

    // Get the updated quantity
    var quantity = parseInt(quantityInput.value);

    // Calculate the new product price
    var productPrice = <?php echo $productPrice; ?>;
    var newProductPrice = productPrice * quantity;

    // Update the price elements
    priceElement.innerText = newProductPrice;
    priceInput.value = newProductPrice;
  }
</script>



</section>
<script src="js/script.js"></script>
<script src="bootstrap-5.3.0-alpha1-dist/bootstrap.min.js"></script>
