<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Please <a href='login.php'>login</a> first.");
}

$conn = new mysqli("localhost", "root", "", "users", 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user's items to show as outfit options
$stmt = $conn->prepare("SELECT id, name, image_path FROM items WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Create Outfit</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gradient-to-t from-sky-100 to-slate-50 min-h-screen">
<?php include 'navi.php'; ?>

<div class="max-w-4xl mx-auto p-8 mt-20 bg-white rounded shadow">
  <h1 class="text-3xl font-bold mb-6 text-center">Create a New Outfit</h1>

  <form action="save_outfit.php" method="POST">
    <div class="mb-4">
      <label class="block font-semibold mb-1">Outfit Name:</label>
      <input type="text" name="outfit_name" required class="w-full px-4 py-2 border rounded" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
      <?php foreach ($items as $item): ?>
        <label class="cursor-pointer border p-3 rounded flex flex-col items-center hover:bg-blue-50">
          <input type="checkbox" name="items[]" value="<?= $item['id'] ?>" class="mb-2" />
          <img src="<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full h-32 object-cover rounded mb-2">
          <span class="text-sm"><?= htmlspecialchars($item['name']) ?></span>
        </label>
      <?php endforeach; ?>
    </div>

    <div class="text-center">
      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save Outfit</button>
    </div>
  </form>
</div>
</body>
</html>
