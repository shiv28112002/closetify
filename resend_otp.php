<?php
session_start();
require 'connect.php';

$email = $_SESSION['reset_email'];

$otp = rand(100000, 999999);
$expiry = date("Y-m-d H:i:s", time() + 300);

$stmt = $mysqli->prepare("UPDATE userdata SET otp=?, otp_expiry=? WHERE email=?");
$stmt->bind_param("sss", $otp, $expiry, $email);
$stmt->execute();

// Show OTP for testing
$_SESSION['debug_otp'] = $otp;

header("Location: verify_otp.php");
exit();
?>