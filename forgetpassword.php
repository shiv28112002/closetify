<?php
session_start();
require 'connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];

    $stmt = $mysqli->prepare("SELECT id FROM userdata WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        // Generate OTP
        $otp = rand(100000, 999999);
        $expiry = date("Y-m-d H:i:s", time() + 300);

        // Store OTP
        $upd = $mysqli->prepare("UPDATE userdata SET otp=?, otp_expiry=? WHERE email=?");
        $upd->bind_param("sss", $otp, $expiry, $email);
        $upd->execute();

        // Store email in session
        $_SESSION['reset_email'] = $email;

        // For testing (dummy project)
        $_SESSION['debug_otp'] = $otp;

        // Redirect to verify page
        header("Location: verify_otp.php");
        exit();

    } else {
        $message = "If email exists, OTP sent.";
    }
}
?>

<form method="post">
    <h2>Forgot Password</h2>
    <input type="email" name="email" placeholder="Enter Email" required>
    <button type="submit">Send OTP</button>
</form>

<p><?php echo $message; ?></p>