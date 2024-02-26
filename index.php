<?php include('header.php') ?>

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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="./images/Logo.png" type="image/png">
</head>

<body>

    <!-- Navbar -->
    <nav class="flex items-center gap-20 h-32 px-8 py-6 border-b-[1px] border-gray-100 sticky top-0 bg-white z-10">
        <img src="./images/Logo.svg" alt="Cesta" class="w-max h-max">
        <ul class="flex gap-10 text-2xl h-full items-center w-full">
            <li><a href="#home">Home</a></li>
            <li><a href="#category">Category</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <input type="text" class="h-full w-full rounded-xl text-xl max-w-[40rem] bg-gray-200 px-10" placeholder="Find fresh fruits & vegetables">
        </ul>
        <ul class="flex flex-none gap-10 text-2xl h-full items-center w-max ml-auto">
            <li><a href="./signup.php">Join Cesta</a></li>
            <li><a href="#cart"><img src="./images/cart.svg" alt="cart" class="w-max h-max"></a></li>
        </ul>
    </nav>
    <!-- Navbar end -->

    <!--home section start-->
    <section class="flex items-center">
        <div class="flex flex-col gap-5">
            <h1 class="text-5xl leading-relaxed font-extrabold">Fill Your Fridge with Freshness: <br />
            Cesta, Your Online Groceries Haven</h1>
            <p class="font-light text-3xl leading-relaxed">Shop smarter, save time, eat well. <br />
            Groceries delivered right to your doorstep anywhere in Kenya.</p>
            <button class="bg-[#007A00] text-white hover:brightness-50 rounded-lg w-max px-4 py-4 text-2xl mt-auto">Start Shopping Now</button>
        </div>
        <div class="flex justify-center w-1/2">
            <img src="./images/basket.png" alt="groceries">
        </div>
    </section>
    <!--home section end-->

    

    <!--banner section starts-->
    <section class="banner-container">

        <div class="banner">
            <img src="images/banner-1.jpg" alt="">
            <div class="content">
                <h3 style="">All the veggies you can eat</h3>
                <p style=" font-size: 15px;">upto 75% off</p>
                <a href="#" class="btn" style=" border-radius: 3px;">Shop Now</a>
            </div>
        </div>

        <div class="banner">
            <img src="images/banner-2.jpg" alt="">
            <div class="content">
                <h3 style="">limited offer</h3>
                <p style=" font-size: 15px;">upto 55% off</p>
                <a href="#" class="btn" style=" border-radius: 3px;">Shop Now</a>
            </div>
        </div>

    </section>
    <!--banner section ends-->

    <!--category section start-->
    <section class="category" id="category">

        <h2 class="text-3xl font-bold my-4">Shop by Category</h2>

        <form action="index.php" method="post">
            <div class="box-container">

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
            if (isset($_POST['fruits'])) {
                echo '<h1 class="heading" style="">All <span style="">Fruits</span></h1>
            ';
            } elseif (isset($_POST['vegetables'])) {
                echo '<h1 class="heading" style="">All <span style="">Vegetables</span></h1>
            ';
            } elseif (isset($_POST['milk'])) {
                echo '<h1 class="heading" style="">All <span style="">Milk</span></h1>
            ';
            } else {
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


                if (isset($_POST['vegetables'])) {
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
<<<<<<< HEAD
                <span class="discount" style="">-' . number_format($percentageOff, 0) . '%</span>
=======
                <span class="discount !z-10" style="">-' . number_format($percentageOff, 0) . '%</span>
>>>>>>> master
                
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
                } elseif (isset($_POST['fruits'])) {
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
                <span class="discount" style="">-' . number_format($percentageOff, 0) . '%</span>
                
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
                } elseif (isset($_POST['milk'])) {
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
                <span class="discount" style="">-' . number_format($percentageOff, 0) . '%</span>
                
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
                } else {
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
                <span class="discount" style="">-' . number_format($percentageOff, 0) . '%</span>
                
<<<<<<< HEAD
                <img src="images/' . $productImage . '" alt="">
                <h3 style="">' . $productName . '</h3>
                
                <div style="" class="price">Ksh ' . $productPrice . ' <span>Ksh ' . $productOldPrice . '</span></div>
=======
                <img src="images/' . $productImage . '" class="hover:scale-95" alt="">
                <h3 class="!text-3xl">' . $productName . '</h3>
                
                <div style="" class="price flex !gap-3 !items-center">Ksh ' . $productPrice . ' <span>Ksh ' . $productOldPrice . '</span></div>
>>>>>>> master
                
                <form method="POST">
                    <input type="hidden" name="product_name" value="' . $productName . '">
                    <input type="hidden" name="product_price" value="' . $productPrice . '">
<<<<<<< HEAD
                    <input type="hidden" name="product_image" value="' . $productImage . '">
                    <div class="quantity">
                    <span style="">quantity :</span>
                    <input style="" type="number" min="1" max="1000" name="product_quantity" value="1">
                    <span style="">/kg</span>
                </div>
                <button type="submit" style="width: 295px; border-radius: 3px;  display: block; margin: 0 auto;" name="add_to_cart" class="btn">Add to Cart</button>
                
=======
                    <input type="hidden" name="product_image" value="' . $productImage . '">     
>>>>>>> master
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

<<<<<<< HEAD
        <section class="contact" id="contact">

            <h1 class="heading" style=""> contact <span style=""> now </span> </h1>

            <div class="row">

                <div class="image">
                    <img src="images/contact.png" alt="">
                </div>

                <form action="contactus.php" method="POST">
                    <div class="inputBox">
                        <input type="text" style="" name="firstname" placeholder="first name">
                        <input type="text" style="" name="lastname" placeholder="last name">
                    </div>

                    <div class="inputBox">
                        <input type="email" style="" name="email" placeholder="email address">
                        <input type="number" style="" name="phone" placeholder="phone">
                    </div>

                    <textarea name="message" style="" placeholder="message" id="" cols="30" rows="10"></textarea>
                    <input type="submit" style=" width: 200px;" value="Send" name="submit" class="btn">

=======
        <!-- <section class="contact" id="contact">

            <h2 class="text-3xl font-bold my-4">Contact Us</h2>

            <div class="row">

                <form action="contactus.php" method="POST">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                        <div class="mt-2">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        </div>

                        <div class="sm:col-span-3">
                        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                        <div class="mt-2">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        </div>

                        <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
>>>>>>> master
                </form>

            </div>

<<<<<<< HEAD
        </section>
=======
        </section> -->
>>>>>>> master

        <!-- end -->
        <!--js file link-->
        <script src="js/script.js"></script>
        <script src="bootstrap-5.3.0-alpha1-dist/bootstrap.min.js"></script>
</body>

</html>