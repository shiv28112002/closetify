<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // ✅ HASH THE PASSWORD
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // ✅ DEBUG OUTPUT (you can remove later)
        echo "Raw Password: " . $password . "<br>";
        echo "Hashed Password: " . $hashed_password . "<br>";

        // ✅ INSERT INTO DATABASE
        $stmt = $mysqli->prepare("INSERT INTO userdata (username, email, password) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }
        $stmt->bind_param('sss', $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;
            header('Location: login.php');
            exit;
        } else {
            $error = "Registration failed: " . $stmt->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
   <?php include'header.php'?>
    <div class="w-full h-full ">
   <div class="bg-cover bg-center bg-[url('./assets/Picsart_25-03-25_21-44-51-776.jpg')]">
    <div class="h-screen flex justify-center items-center w-full">
        <div class="bg-white mx-4 p-8 rounded-xl shadow-md w-full md:w-1/2 lg:w-1/3">
            <h1 class="text-3xl font-bold mb-8 text-center">Register Here!</h1>
            <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form method="POST" action="">
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2" for="username">
                        Full Name
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "
                        id="username" type="username" placeholder="Enter your full name" name="username" required />
                </div>
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2" for="email ">
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
                        class="border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline "
                        id="password" type="password" placeholder="Enter your password" name="password" required />
                </div>
                <div class="mb-6">
                   <button type="submit" 
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                   Sign up now</button>
        <p class="text-sm font-light text-gray-500 ">Already have an account! <a
            class="font-medium text-blue-600 hover:underline" href="./login.php">Sign in here.</a>
        </p>
                
                </div>
            </form>
        </div>
    </div>
</div>
</div>
    

</body>
</html>