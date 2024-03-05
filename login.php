<?php
include('header.php');
session_start();
include 'dbcon.php';
$sql = mysqli_query($dbconn, "SELECT * FROM signup");

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

    <section class="flex gap-20 w-full items-center gap-8 h-[80vh] w-[80vw]">
        <div class="flex flex-col gap-2 w-1/2 items-center h-3/5">
            <div class="flex flex-col gap-4">
                <img src="./images/icon.svg" alt="cesta" class="w-max h-max">
                <h2 class="text-5xl font-bold leading-normal">Welcome back to Cesta <br /> were glad to have you</h2>
                <p class="text-2xl font-medium">Login to get started</p>
            </div>
        </div>
        <form action="login.php" class="w-max flex flex-col gap-4">
            <input type="email" name="email" id="email" placeholder="Email" class="border-2 focus:border-green-900 focus:border-black bg-zinc-100 px-6 text-2xl rounded-lg h-20" required>
            <input type="password" name="password" id="password" placeholder="Password" class="border-2 focus:border-green-900 focus:border-black bg-zinc-100 px-6 text-2xl rounded-lg h-20" required>
            <button action="submit" name="login" class="hover:bg-gray-800 text-2xl h-20 bg-green-900 w-full text-white font-light rounded-lg border-2 border-green-900 border-offset-100 focus:border-black">Login</button>
            <a href="./signup.php" class="text-center text-2xl mt-4 text-blue-600">Signup instead</a>
        </form>
    </section>

    <script>
        // Get the input element
        var contactInput = document.getElementById("contactInput");

        // Add event listener for input event
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