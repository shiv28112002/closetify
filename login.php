<?php
session_start();
require 'connect.php';

// show errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, username, password FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id']  = $id;
            $_SESSION['username'] = $username;
            
            header("Location:homepage.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account found with that email.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <?php include'header.php'?>
    <div class="w-full h-full">
     <div class="bg-cover bg-center bg-[url('./assets/Picsart_25-03-25_21-44-51-776.jpg')]">
    <div class="h-screen flex justify-center items-center">
        <div class="bg-white mx-4 p-8 rounded-xl shadow-md w-full md:w-1/2 lg:w-1/3">
            <h1 class="text-3xl font-bold mb-8 text-center">Sign in here!</h1>
            <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form method="post" action="login.php">
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2" for="email">
                        Email Address
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="email" placeholder="Enter your email address" name="email" required/>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="Enter your password" name="password" required />
                    <a class="text-gray-600 hover:text-gray-800" href="./forgetpassword.php">Forgot your password?</a>
                </div>
                <div class="mb-6">
                <button type="submit" 
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                   Sign in</button>
        <p class="text-sm font-light text-gray-500 ">Don't have an account? <a
            class="font-medium text-blue-600 hover:underline " href="./register.php">Sign up here.</a>
        </p>
                
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>
    
</html>