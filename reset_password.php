<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['otp_verified'])) {
    header("Location: forgot_password.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($pass !== $confirm) {
    $message = " Passwords do not match!";
} else {

    $email = $_SESSION['reset_email'];
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE userdata SET password=?, otp=NULL, otp_expiry=NULL WHERE email=?");
    $stmt->bind_param("ss", $hash, $email);
    $stmt->execute();

    session_destroy();

    // Show login link after success
    $message = " Password updated successfully! 
    <br><a href='login.php'> Go to Login Page</a>";
}
}
?>

<form method="post">
    <h2>Reset Password</h2>
    <input type="password" name="password" placeholder="New Password" required>
    <input type="password" name="confirm" placeholder="Confirm Password" required>
    <button type="submit">Reset</button>
</form>

<p><?php echo $message; ?></p>