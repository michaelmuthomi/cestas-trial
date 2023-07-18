<?php
// Assuming you have a database connection established
include 'dbcon.php';

// Retrieve cart items from the database
$sql = "SELECT * FROM cart";
$result = mysqli_query($dbconn, $sql);

// Calculate the total amount
$totalAmount = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productPrice = $row['price'];
        $productQuantity = $row['quantity'];
        $subtotal = $productPrice * $productQuantity;
        $totalAmount += $subtotal;
    }
}

// Handle M-Pesa payment
if (isset($_POST['pay_mpesa'])) {
    session_start();

    if(!isset($_SESSION['contact'])){
        header("Location: signup.php");
    }
    echo $_SESSION['contact'];
// API Endpoint URL
// Handle M-Pesa payment
if (isset($_POST['pay_mpesa'])) {

    if (!isset($_SESSION['contact'])) {
        header("Location: signup.php");
        exit(); // Make sure to exit after redirecting
    }

    // API Endpoint URL
    $apiEndpoint = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    // API Key
    $apiKey = 'EfvdYsAe1yN0if6koDPvsW5RXEM9IDjR';

    // Payment details
    $amount = 100; // Replace with the actual payment amount
    $phoneNumber = $_SESSION['contact']; // Replace with the customer's phone number

    // Prepare the request data
    $data = array(
        'BusinessShortCode' => '174379', // Replace with your business short code
        'Password' => 'Safaricom999!*!', // Replace with your API password
        'Timestamp' => date('YmdHis'),
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phoneNumber,
        'PartyB' => '600000', // Replace with your business short code
        'PhoneNumber' => $phoneNumber,
        'CallBackURL' => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', // Replace with your callback URL
        'AccountReference' => 'YourAccountReference', // Replace with your account reference
        'TransactionDesc' => 'Payment for products' // Replace with your transaction description
    );

    // Generate the password using the provided format
    $password = base64_encode('YourBusinessShortCode' . 'YourPassword' . date('YmdHis'));
    $data['Password'] = $password;

    // Convert the data to JSON format
    $jsonData = json_encode($data);

    // Create HTTP headers
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    );

    // Initialize cURL session
    $curl = curl_init();

    // Set the cURL options
    curl_setopt($curl, CURLOPT_URL, $apiEndpoint);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        $error = curl_error($curl);
        // Handle the error appropriately
        echo 'cURL Error: ' . $error;
    } else {
        // Process the API response
        $responseData = json_decode($response, true);

        // Check the response status and take appropriate actions
        if (isset($responseData['ResponseCode']) && $responseData['ResponseCode'] == '0') {
            // Payment request successful
            $transactionId = $responseData['MerchantRequestID'];
            // Redirect the user to a success page or perform further actions
            header('Location: cart.php?transaction_id=' . $transactionId);
            exit();
        } else {
            // Payment request failed
            $errorMessage = $responseData['errorMessage'];
            // Display the error message to the user or take appropriate actions
            echo 'Payment Error: ' . $errorMessage;
        }
    }

    // Close the cURL session
    curl_close($curl);
}


}

// Handle PayPal payment
if (isset($_POST['pay_paypal'])) {
    // Implement your PayPal payment logic here

    // Provide feedback to the user
    echo "<script>alert('PayPal payment completed.')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Now</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="product" id="product">
        <header>
            <div class="header-2">
                <div id="menu-bar" class="fa-sharp fa-solid fa-bars"></div>
                <nav class="navbar">
                    <a href="index.php" class="nav-link active">Home</a>
                </nav>
            </div>
        </header>
        <h1 class="heading">Pay Now</h1>

        <div class="box-container">
            <h2>Total Amount: Ksh <?php echo $totalAmount; ?></h2>

            <form method="POST">
                <div class="button-container">
                    <button type="submit" name="pay_mpesa" class="btn">Pay with M-Pesa</button>
                    <button type="submit" name="pay_paypal" class="btn">Pay with PayPal</button>
                </div>
            </form>
        </div>
    </section>

    <script src="js/script.js"></script>
    <script src="bootstrap-5.3.0-alpha1-dist/bootstrap.min.js"></script>
</body>

</html>
