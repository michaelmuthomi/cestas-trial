<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lipa na mpesa</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
  <link href="" rel="stylesheet" />
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" ">
    <script
      type=" text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  </script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap");

    body {
      background-color: #eaedf4;
      font-family: "Rubik", sans-serif;
    }

    .card {
      width: 310px;
      border: none;
      border-radius: 15px;
    }

    .justify-content-around div {
      border: none;
      border-radius: 20px;
      background: #f3f4f6;
      padding: 5px 20px 5px;
      color: #8d9297;
    }

    .justify-content-around span {
      font-size: 12px;
    }

    .justify-content-around div:hover {
      background: #545ebd;
      color: #fff;
      cursor: pointer;
    }

    .justify-content-around div:nth-child(1) {
      background: #545ebd;
      color: #fff;
    }

    span.mt-0 {
      color: #8d9297;
      font-size: 12px;
    }

    h6 {
      font-size: 15px;
    }

    .mpesa {
      background-color: green !important;
    }

    img {
      border-radius: 15px;
    }
  </style>
</head>

<body oncontextmenu="return false" class="snippet-body">
  <div class="container d-flex justify-content-center">
    <div class="card mt-5 px-3 py-4">
      <div class="d-flex flex-row justify-content-around">
        <div class="mpesa"><span>Mpesa </span></div>
        <?php // Start the session (if not already started)
// session_start();
        
        // Retrieve the total price from the session
        if (isset($_SESSION['total_price'])) {
          $totalPrice = 100;
        } else {
          // Handle the case when the 'totalprice' session variable is not set
          // You can set a default value or show an error message, for example
          $totalPrice = 0; // Default value
        }

        // Your PayPal form code here, and you can use $totalPrice wherever you need it
        
        echo '<form class="paypal" action="../paypal/payments.php" method="post" id="paypal_form" target="_blank">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="lc" value="" />
        <input type="hidden" name="currency_code" value="" />
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input type="hidden" name="first_name" value="Customers First Name"  />
        <input type="hidden" name="last_name" value="Customers Last Name"  />
        <input type="hidden" name="payer_email" value="' . $_SESSION['email'] . '"  />
        <input type="hidden" name="item_number" value="123456" / >
    <div><span><button type="submit" style="background-color: transparent; border:none; width: 80px;">Paypal</button></span></div>
        </form>';
        ?>



        <div><span>Card</span></div>
      </div>
      <div class="media mt-4 pl-2">
        <img src="./images/1200px-M-PESA_LOGO-01.svg.png" class="mr-3" height="75" />
        <div class="media-body">
          <h6 class="mt-1">Enter Amount & Number</h6>
        </div>
      </div>
      <div class="media mt-3 pl-2">
        <!--bs5 input-->



        <?php
        // Start the session
        include '../dbcon.php';

        if (!isset($_SESSION['contact'])) {
          header("Location: ../signup.php");
        }

        // Retrieve the phone number from the session
        $phoneNumber = $_SESSION['contact'];
        $productName = $_SESSION['name'];
        $productPrice = $_SESSION['price'];
        $productQuantity = $_SESSION['quantity'];
        $productImage = $_SESSION['image'];


        // Remove the product from the cart table
        $removeSql = "DELETE FROM cart WHERE name = '$productName'";
        mysqli_query($dbconn, $removeSql);

        $insertSql = "INSERT INTO orders (name, quantity, image, contact) VALUES ('$productName', '$productQuantity', '$productImage', '$phoneNumber')";
        $query = mysqli_query($dbconn, $insertSql);

        ?>

        <form class="row g-3" action="./stk_initiate.php" method="POST">
          <?php
          if (isset($_POST['product_price'])) {
            echo '<div class="col-12">
        <label for="inputAddress" class="form-label">Amount</label>
        <input type="text" class="form-control" name="amount" placeholder="Enter Amount" value=' . $_POST['product_price'] . '>
    </div>';
          } else {
            echo '<div class="col-12">
        <label for="inputAddress" class="form-label">Amount</label>
        <input type="text" class="form-control" name="amount" placeholder="Enter Amount" value=' . $_POST['total_price'] . '>
    </div>';
          }
          ?>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number"
              value="<?php echo $phoneNumber; ?>">
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-success" name="submit" value="submit">Pay Now</button>
          </div>
        </form>

        <!--bs5 input-->
      </div>
    </div>
  </div>
  </div>
  <script type="text/javascript"
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src=""></script>
  <script type="text/javascript" src=""></script>
  <script type="text/Javascript"></script>
</body>

</html>