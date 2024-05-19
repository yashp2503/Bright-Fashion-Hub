<?php

session_start();
error_reporting(0); 
require_once '../config/dbcon.php';

if (isset($_SESSION['auth'])) {
    if (isset($_POST['placeOrderBtn'])) {
        // Your existing code for placing orders
    } elseif (isset($_POST['onlinePayBtn'])) {
        // Paytm Integration
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode2']);
        $payment_id = "pyid".rand(1111,9999);
        $tracking_no = "trkid".rand(1111,9999).substr($phone,2);
        
        // Your existing code to calculate total price
        $totalPrice = calculateTotalPrice(); // You need to implement this function
        
        // Prepare Paytm request parameters
        $paytmParams = array(
            "MID" => "eOWSGE78697499787844",
            "ORDER_ID" => "ORDER_ID_HERE", // Generate a unique order ID
            "TXN_AMOUNT" => $totalPrice, // Total amount to be paid
            "CUST_ID" => $user_id, // Customer ID
            "INDUSTRY_TYPE_ID" => "INDUSTRY_TYPE_ID_HERE",
            "CHANNEL_ID" => "WEB",
            "WEBSITE" => "WEBSTAGING", // For testing, use "WEBSTAGING". For production, use "DEFAULT"
            "CALLBACK_URL" => "http://yourwebsite.com/paytm_callback.php", // Callback URL
        );
        
        // Generate checksum
        $checksum = PaytmChecksum::generateSignature($paytmParams, "YOUR_PAYTM_MERCHANT_KEY");
        
        // Add checksum to request parameters
        $paytmParams["CHECKSUMHASH"] = $checksum;
        
        // Build Paytm transaction URL
        $paytmURL = "https://securegw-stage.paytm.in/theia/processTransaction";
        
        // Redirect to Paytm payment page
        header("Location: $paytmURL?" . http_build_query($paytmParams));
        exit;
    }
} else {
    header('Location: ../login.php');
    exit;
}

?>
