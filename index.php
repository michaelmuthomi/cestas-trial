<?php include ('header.php')?>

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

</style>

<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <!--header section starts-->
    <header>
        
        <div class="header-1">
            <a href="#" style="" class ="logo"><i class="fa-solid fa-basket-shopping"></i></i>Cesta</a>
            
        </div>
        <!--header 2-->
        
        <div class=" header-2 ">

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
                    echo '<span style="color: #2c2c54;   font-size: 15px; margin-top: 50px; border-radius: 50%;">'.$totalItems.'</span>';
                ?>
                </a>
                <a href="signup.php" class="fa-sharp fa-solid fa-circle-user"></a>
               </div>
        </div>
           
    </header>
    <!--header section ends-->
    
    <!--home section start-->
    <section class="home" id="home">
        <div class="image">
            <img src="images/home-img.png" alt="">
        </div>

        <div class="content">
            <span style=" font-size: 20px;">fresh and organic</span>
            <h3 style="">groceries at your fingertips</h3>
            <a href="#product" class="btn" style=" border-radius: 5px;">get started</a>
        </div>

    </section>
    <!--home section end-->

    <!--banner section starts-->
    <section class="banner-container">

        <div class="banner">
            <img src="images/banner-1.jpg" alt="">
            <div class="content">
                <h3 style="">special offer</h3>
                <p style=" font-size: 15px;">upto 75% off</p>
                <a href="#" class="btn" style=" border-radius: 3px;">bill out</a>
            </div>
        </div>
    
        <div class="banner">
            <img src="images/banner-2.jpg" alt="">
            <div class="content">
                <h3 style="">limited offer</h3>
                <p style=" font-size: 15px;">upto 55% off</p>
                <a href="#" class="btn" style=" border-radius: 3px;">bill out</a>
            </div>
        </div>
    
    </section>
    <!--banner section ends-->

    <!--category section start-->
    <section class="category" id="category">

        <h1 class="heading" style="">shop by <span style="">category</span></h1>
    
        <form action="index.php" method="post">
        <div class="box-container" >

            <div class="box">
                <h3 style="">vegetables</h3>
                <p style="">upto 50% off</p>
                <img src="images/category-1.png" alt="">
                <a>
                    <button type="submit" style=" width: 300px;" class="btn" name="vegetables">shop now</button>
                </a>
            </div>

            <div class="box">
                <h3 style="">milk</h3>
                <p style="">upto 40% off</p>
                <img src="images/category-2.png" alt="">
                <a>
                    <button type="submit" style=" width: 300px;" class="btn" name="milk">shop now</button>
                </a>
            </div>

            <div class="box">
                <h3 style="">fruits</h3>
                <p style="">upto 12% off</p>
                <img src="images/category-4.png" alt="">
                <a>
                    <button type="submit" style=" width: 290px;" class="btn" name="fruits">shop now</button>
                </a>
                
                
            </div>

        </div>
        </form>
        <script>
    function scrollToProducts(event) {
        event.preventDefault(); // Prevent the form from submitting immediately
        
        // Scroll to the product section
        const productsSection = document.getElementById('products-section');
        productsSection.scrollIntoView({ behavior: 'smooth' });
        
        // You can submit the form here if needed
        // event.target.submit();
    }
</script>
    
    </section>
    
    <!-- category section ends -->

    <!-- product section starts  -->

    <form action="addtocart" method="post">
    <section class="product" id="product">
    <?php
        if(isset($_POST['fruits'])){
            echo '<h1 class="heading" style="">All <span style="">Fruits</span></h1>
            ';
        }elseif(isset($_POST['vegetables'])){
            echo '<h1 class="heading" style="">All <span style="">Vegetables</span></h1>
            ';
        }elseif(isset($_POST['milk'])){
            echo '<h1 class="heading" style="">All <span style="">Milk</span></h1>
            ';
        }else{
            echo '<h1 class="heading" style="">All <span style="">Products</span></h1>
            '; 
        }
    ?>
<div class="box-container">
<?php

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


if(isset($_POST['vegetables'])){
    $sql = "SELECT * FROM products WHERE type='vegetable'";
    $result = mysqli_query($dbconn, $sql);

// Check if there are any products
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productName = $row['name'];
        $productImage = $row['image'];
        $productPrice = $row['newprice'];
        $productOldPrice = $row['oldprice'];
        $percentageOff = ($productOldPrice - $productPrice) / $productOldPrice * 100;

        // Generate HTML code for each product
        echo '<div class="box">
                <span class="discount" style="">-'.number_format($percentageOff, 0).'%</span>
                
                <img src="images/' . $productImage . '" alt="">
                <h3 style="">' . $productName . '</h3>
                
                <div style="" class="price">Ksh ' . $productPrice . ' <span>Ksh ' . $productOldPrice . '</span></div>
                
                <form method="POST">
                    <input type="hidden" name="product_name" value="' . $productName . '">
                    <input type="hidden" name="product_price" value="' . $productPrice . '">
                    <input type="hidden" name="product_image" value="' . $productImage . '">
                    <div class="quantity">
                    <span style="">quantity :</span>
                    <input style="" type="number" min="1" max="1000" name="product_quantity" value="1">
                    <span style="">/kg</span>
                </div>
                <button type="submit" style="width: 295px; border-radius: 3px;  display: block; margin: 0 auto;" name="add_to_cart" class="btn">Add to Cart</button>
                
                </form>
            </div>';
    }

}
}elseif(isset($_POST['fruits'])){
    $sql = "SELECT * FROM products WHERE type='fruit'";
    $result = mysqli_query($dbconn, $sql);

// Check if there are any products
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productName = $row['name'];
        $productImage = $row['image'];
        $productPrice = $row['newprice'];
        $productOldPrice = $row['oldprice'];
        $percentageOff = ($productOldPrice - $productPrice) / $productOldPrice * 100;

        // Generate HTML code for each product
        echo '<div class="box">
                <span class="discount" style="">-'.number_format($percentageOff, 0).'%</span>
                
                <img src="images/' . $productImage . '" alt="">
                <h3 style="">' . $productName . '</h3>
                
                <div style="" class="price">Ksh ' . $productPrice . ' <span>Ksh ' . $productOldPrice . '</span></div>
                
                <form method="POST">
                    <input type="hidden" name="product_name" value="' . $productName . '">
                    <input type="hidden" name="product_price" value="' . $productPrice . '">
                    <input type="hidden" name="product_image" value="' . $productImage . '">
                    <div class="quantity">
                    <span style="">quantity :</span>
                    <input style="" type="number" min="1" max="1000" name="product_quantity" value="1">
                    <span style="">/kg</span>
                </div>
                <button type="submit" style="width: 295px; border-radius: 3px;  display: block; margin: 0 auto;" name="add_to_cart" class="btn">Add to Cart</button>
                
                </form>
            </div>';
    }

}
}elseif(isset($_POST['milk'])){
    $sql = "SELECT * FROM products WHERE type='milk'";
    $result = mysqli_query($dbconn, $sql);

// Check if there are any products
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productName = $row['name'];
        $productImage = $row['image'];
        $productPrice = $row['newprice'];
        $productOldPrice = $row['oldprice'];
        $percentageOff = ($productOldPrice - $productPrice) / $productOldPrice * 100;

        // Generate HTML code for each product
        echo '<div class="box">
                <span class="discount" style="">-'.number_format($percentageOff, 0).'%</span>
                
                <img src="images/' . $productImage . '" alt="">
                <h3 style="">' . $productName . '</h3>
                
                <div style="" class="price">Ksh ' . $productPrice . ' <span>Ksh ' . $productOldPrice . '</span></div>
                
                <form method="POST">
                    <input type="hidden" name="product_name" value="' . $productName . '">
                    <input type="hidden" name="product_price" value="' . $productPrice . '">
                    <input type="hidden" name="product_image" value="' . $productImage . '">
                    <div class="quantity">
                    <span style="">quantity :</span>
                    <input style="" type="number" min="1" max="1000" name="product_quantity" value="1">
                    <span style="">/kg</span>
                </div>
                <button type="submit" style="width: 295px; border-radius: 3px;  display: block; margin: 0 auto;" name="add_to_cart" class="btn">Add to Cart</button>
                
                </form>
            </div>';
    }

}
}
else{
    // Query to retrieve products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($dbconn, $sql);

// Check if there are any products
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productName = $row['name'];
        $productImage = $row['image'];
        $productPrice = $row['newprice'];
        $productOldPrice = $row['oldprice'];
        $percentageOff = ($productOldPrice - $productPrice) / $productOldPrice * 100;

        // Generate HTML code for each product
        echo '<div class="box">
                <span class="discount" style="">-'.number_format($percentageOff, 0).'%</span>
                
                <img src="images/' . $productImage . '" alt="">
                <h3 style="">' . $productName . '</h3>
                
                <div style="" class="price">Ksh ' . $productPrice . ' <span>Ksh ' . $productOldPrice . '</span></div>
                
                <form method="POST">
                    <input type="hidden" name="product_name" value="' . $productName . '">
                    <input type="hidden" name="product_price" value="' . $productPrice . '">
                    <input type="hidden" name="product_image" value="' . $productImage . '">
                    <div class="quantity">
                    <span style="">quantity :</span>
                    <input style="" type="number" min="1" max="1000" name="product_quantity" value="1">
                    <span style="">/kg</span>
                </div>
                <button type="submit" style="width: 295px; border-radius: 3px;  display: block; margin: 0 auto;" name="add_to_cart" class="btn">Add to Cart</button>
                
                </form>
            </div>';
    }
} else {
    echo "<script>alert('No products Found.')</script>";
}
}
?>

</div>


</section>

<!-- product section ends -->

 <!-- contact -->

 <section class="contact" id="contact">

    <h1 class="heading" style=""> contact <span style=""> now </span> </h1>

    <div class="row">

        <div class="image">
            <img src="images/contact.png" alt="">
        </div>

        <form action="contactus.php" method="POST" >
            <div class="inputBox" >
                <input type="text" style="" name="firstname" placeholder="first name">
                <input type="text"   style="" name="lastname" placeholder="last name">
            </div>

            <div class="inputBox">
                <input type="email" style=""  name="email" placeholder="email address">
                <input type="number"  style="" name="phone" placeholder="phone">
            </div>

            <textarea  name="message" style="" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" style=" width: 200px;" value="Send" name="submit" class="btn">
            
        </form>

    </div>

</section>

<!-- end -->
    <!--js file link-->
    <script src="js/script.js"></script>
    <script src="bootstrap-5.3.0-alpha1-dist/bootstrap.min.js"></script>
</body>
</html>