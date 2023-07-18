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
      <a href="#" style="" class="logo"><i class="fa-solid fa-basket-shopping"></i></i>Cesta- Contact</a>
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
   <!-- contact -->

<section class="contact" id="contact">

<h1 class="heading" style=""> contact Us <span style=""> now </span> </h1>

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
<script src="js/script.js"></script>
    <script src="bootstrap-5.3.0-alpha1-dist/bootstrap.min.js"></script> 
</body>
</html>