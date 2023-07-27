<?php include('header.php'); ?>
<?php include 'dbcon.php'; ?>

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

<body>
  <!--header section starts-->
  <header>
    <div class="header-1">
      <a href="#" style="" class="logo"><i class="fa-solid fa-basket-shopping"></i></i>Cesta- Admin Panel</a>
      <form action="" class="search-box-container">

      </form>
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

  <table>
        <th>id</th>
      <th>name</th>
      <th>quantity</th>
      <th>image</th>
      <th>shipped</th>
      <th>Action</th>
    </tr>

    <?php
    $connect = "SELECT * FROM orders";
    $query = mysqli_query($dbconn, $connect);

    // Loop through the fetched data and populate the table rows
    while ($row = mysqli_fetch_assoc($query)) {
      echo '<tr>';
      echo '<td>' . $row['id'] . '</td>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['quantity'] . '</td>';
      echo '<td><img style="width: 40px; height: 40px;" src="images/' . $row['image'] . '"></td>';
      echo '<td>' . $row['shipped'] . '</td>';
      echo '<td>
            <button style="color: white; background-color: green; padding: 5px; border-radius: 5px;"><a style="color: white;" href="shipped.php?id=' . $row['id'] . '">Shipped</a></button>
            <button style="color: white; background-color: red; padding: 5px; border-radius: 5px;"><a  style="color: white;"  href="notshipped.php?id=' . $row['id'] . '">Not Shipped</a></button>
          </td>';
      echo '</tr>';
    }
    ?>
  </table>


  <!--js file link-->
  <script src="js/script.js"></script>
  <script src="bootstrap-5.3.0-alpha1-dist/bootstrap.min.js"></script>
</body>

</html>
