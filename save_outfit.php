<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Please <a href='login.php'>login</a> first.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['outfit_name']) || empty($_POST['items']) || !is_array($_POST['items'])) {
        die("Missing outfit name or items.");
    }

    $conn = new mysqli("localhost", "root", "", "users", 3307);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $outfit_name = htmlspecialchars(trim($_POST['outfit_name']), ENT_QUOTES);
    $item_ids = array_map('intval', $_POST['items']);
    $items_json = json_encode($item_ids);

    $stmt = $conn->prepare("INSERT INTO outfits (user_id, outfit_name, items) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $outfit_name, $items_json);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: outfits.php?success=1");
        exit();
    } else {
        die("Error saving outfit: " . $stmt->error);
    }
} else {
    header("Location: looks.php");
    exit();
}
