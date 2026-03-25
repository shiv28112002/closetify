<?php
session_start();
require 'connect.php';

$message = "";

// Check session
if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['reset_email'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $entered_otp = $_POST['otp'];

    $stmt = $mysqli->prepare("SELECT otp, otp_expiry FROM userdata WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($db_otp, $expiry);
    $stmt->fetch();

    if ($entered_otp == $db_otp && strtotime($expiry) > time()) {

        $_SESSION['otp_verified'] = true;

        header("Location: reset_password.php");
        exit();

    } else {
        $message = "Invalid or expired OTP!";
    }
}
?>

<h2>Verify OTP</h2>

<!-- Show OTP for testing -->
<?php if (isset($_SESSION['debug_otp'])) { ?>
    <p style="color:green;">Your OTP (for testing): <b><?php echo $_SESSION['debug_otp']; ?></b></p>
<?php } ?>

<form method="post">
    <input type="text" name="otp" placeholder="Enter OTP" required>
    <button type="submit">Verify</button>
</form>

<p><?php echo $message; ?></p>

<!-- Timer -->
<p id="timer"></p>

<script>
let timeLeft = 300;
let timer = setInterval(() => {
    let m = Math.floor(timeLeft/60);
    let s = timeLeft%60;
    document.getElementById("timer").innerHTML = "Expires in: "+m+":"+(s<10?"0":"")+s;
    timeLeft--;
    if(timeLeft<0){
        clearInterval(timer);
        document.getElementById("timer").innerHTML="OTP expired!";
    }
},1000);
</script>

<a href="resend_otp.php">Resend OTP</a>
