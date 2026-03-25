<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please <a href='login.php'>login</a> first.");
}

// Database connection
$conn = new mysqli("localhost", "root", "", "users", 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch all clothing items for the user
$stmt = $conn->prepare("SELECT id, name, color, occasion, season, image_path FROM items WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Collection</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen bg-gradient-to-t from-sky-100 to-slate-50">
  <?php include'navi.php'?>
  <div class="max-w-6xl mx-auto p-6 mt-20">
    <h1 class="text-4xl font-bold mb-6 text-center"> My Wardrobe Gallery</h1>
    
    <?php if (empty($items)): ?>
      <p class="text-center text-gray-600">No items found. <a href="add-item.php" class="text-blue-600 hover:underline">Add some clothes</a>.</p>
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($items as $item): ?>
          <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
            <img src="<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full h-56 object-cover rounded mb-4" />
            <h2 class="text-lg font-semibold mb-1"><?= htmlspecialchars($item['name']) ?></h2>
            <p class="text-sm text-gray-500">Color: <?= htmlspecialchars($item['color']) ?></p>
            <p class="text-sm text-gray-500">Season: <?= htmlspecialchars($item['season']) ?></p>
            <p class="text-sm text-gray-500">Occasion: <?= htmlspecialchars($item['occasion']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="mt-8 text-center">
      <a href="upload.php" class="text-blue-600 hover:underline">+ Add New Item</a>
    </div>
  </div>
</body>
</html>
