<?php
$conn = new mysqli("localhost", "root", "", "users", 3307);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $img = file_get_contents($_FILES['photo']['tmp_name']);
    $stmt = $conn->prepare("INSERT INTO user_photos (image) VALUES (?)");
    $stmt->bind_param("s", $null);
    $stmt->send_long_data(0, $img);
    $stmt->execute();
    echo "Uploaded!";
}
?>

