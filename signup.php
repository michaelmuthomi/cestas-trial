<?php include('header.php');
session_start();
include 'dbcon.php';
$sql = mysqli_query($dbconn, "SELECT * FROM signup");


if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $contact = $_POST['contact'];

    $connect = "INSERT signup(username, email, password, contact) VALUES ('$username','$email','$password','$contact')";
    $query = mysqli_query($dbconn, $connect);

    if ($query) {
        echo '<script>alert("SignUp Successfully")</script>';
        header("Refresh: 1; url=index.php");


        $_SESSION['contact'] = $contact;
        $_SESSION['loggedIn'] = true;
    } else {
        echo '<script>alert("Submission Failed!")</script>';
    }
}
?>
<?php
// ... your existing code ...

if (isset($_POST['login'])) {
    $login_email = $_POST['login_email'];
    $login_password = sha1($_POST['login_password']);

    $query = "SELECT * FROM signup WHERE email='$login_email' AND password='$login_password'";
    $result = mysqli_query($dbconn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Valid credentials, retrieve the contact from the database
        $row = mysqli_fetch_assoc($result);
        $contact = $row['contact'];
        $email = $row['email'];

        // Set session cookies and redirect to cart.php

        $_SESSION['contact'] = $contact;
        $_SESSION['email'] = $email;
        $_SESSION['loggedIn'] = true;

        header("Location: cart.php");
        exit(); // Make sure to exit after redirecting
    } else {
        // Invalid credentials, show JavaScript popup
        echo '<script>alert("Invalid credentials")</script>';
    }
}
?>


<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="./images/Logo.png" type="image/png">
</head>

<style>
    .sign_up {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        margin-top: 10px;
    }

    .sign_up .logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .sign_up h1 {
        margin-top: 0;
        margin-bottom: 10px;
    }

    .sign_up .text-muted {
        font-size: 14px;
    }

    .sign_up .form-control {
        margin-bottom: 10px;
    }

    .sign_up .form-group {
        text-align: center;
    }

    input {
        width: 350px;
        height: 40px;
        padding: 0px 0px 0px 17px;
    }

    .tab {
        display: none;
    }

    .tab.active {
        display: block;
    }

    .tab-content {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        margin-top: 10px;
    }

    .tab-buttons {
        text-align: center;
        margin-top: 10px;
    }

    .tab-buttons button {
        padding: 10px 20px;
        margin-right: 10px;
        cursor: pointer;
    }
</style>

<body>
    <!--header section starts-->
    <nav class="flex items-center gap-20 h-32 px-8 py-6 border-b-[1px] border-gray-100 sticky top-0 bg-white z-10">
        <img src="./images/Logo.svg" alt="Cesta" class="w-max h-max">
        <ul class="flex gap-10 text-2xl h-full items-center w-full">
            <li><a href="index.php#">Home</a></li>
            <li><a href="index.php#category">Category</a></li>
            <li><a href="index.php#contact">Contact Us</a></li>
            <input type="text" class="h-full w-full rounded-xl text-xl max-w-[40rem] bg-gray-200 px-10" placeholder="Find fresh fruits & vegetables">
        </ul>
        <ul class="flex flex-none gap-10 text-2xl h-full items-center w-max ml-auto">
            <li><a href="./signup.php">Join Cesta</a></li>
            <li><a href="#cart"><img src="./images/cart.svg" alt="cart" class="w-max h-max"></a></li>
        </ul>
    </nav>
    <!--header section ends-->


    <section class="flex gap-20 w-full items-center gap-8  h-[80vh]">
        <div class="flex flex-col gap-2 w-1/2 items-center h-3/5">
            <div class="flex flex-col gap-4">
                <img src="./images/icon.svg" alt="cesta" class="w-max h-max">
                <h2 class="text-5xl font-bold leading-snug">Welcome to Cesta <br /> were glad to have you</h2>
                <p class="text-2xl font-medium">Sign up to get started</p>
            </div>
        </div>
        <form action="signup.php" class="w-max flex flex-col gap-4">
            <input type="text" name="username" id="username" placeholder="Full name" class="bg-zinc-100 px-6 text-2xl rounded-lg h-20">
            <input type="text" name="contact" id="contactInput" placeholder="Contact" class="bg-zinc-100 px-6 text-2xl rounded-lg h-20">
            <input type="email" name="email" id="email" placeholder="Email" class="bg-zinc-100 px-6 text-2xl rounded-lg h-20">
            <input type="password" name="password" id="password" placeholder="Password" class="bg-zinc-100 px-6 text-2xl rounded-lg h-20">
            <button type="submit" name="signup" class="hover:bg-gray-800 text-2xl h-20 bg-black w-full text-white font-light rounded-lg">Sign Up</button>
            <a href="./login.php" class="text-center text-2xl mt-4 text-blue-600">Login instead</a>
        </form>
    </section>
  </div>

            </form>
        </div>
    </div>
    <script>
        contactInput.addEventListener("input", function (event) {
            var input = event.target.value;

            // Remove any non-digit characters
            var digitsOnly = input.replace(/\D/g, "");

            // Restrict the length to 9 characters
            var trimmedValue = digitsOnly.slice(0, 12);

            // Prepend "254" to the trimmed value
            var contactValue = trimmedValue;

            // Update the input value
            event.target.value = contactValue;
        });
    </script>





    <script>
        // JavaScript to handle tab switching
        function showTab(tabName) {
            const tabs = document.getElementsByClassName('tab');
            const tabButtons = document.getElementsByClassName('tab-button');

            for (let i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }

            for (let i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove('active');
            }

            const tabToShow = document.getElementById(tabName);
            tabToShow.classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>
    <script src="js/script.js"></script>
    <script src="bootstrap-5.3.0-alpha1-dist/bootstrap.min.js"></script>
</body>

</html>