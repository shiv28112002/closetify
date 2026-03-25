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

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmtDel = $conn->prepare("DELETE FROM outfits WHERE id = ? AND user_id = ?");
    $stmtDel->bind_param("ii", $delete_id, $user_id);
    $stmtDel->execute();
    $stmtDel->close();
    header("Location: looks.php");
    exit;
}

// Fetch saved outfits
$stmt = $conn->prepare("SELECT id, outfit_name, items FROM outfits WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$outfits = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

function getItemsByIds($conn, $ids) {
    if (empty($ids)) return [];
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $types = str_repeat('i', count($ids));
    $stmt = $conn->prepare("SELECT id, name, image_path FROM items WHERE id IN ($placeholders)");
    $stmt->bind_param($types, ...$ids);
    $stmt->execute();
    $res = $stmt->get_result();
    $items = $res->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $items;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Saved Outfits</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-gradient-to-t from-sky-100 to-slate-50">
  <?php include 'navi.php'; ?>

  <div class="max-w-6xl mx-auto p-6 mt-20">
    <h1 class="text-4xl font-bold mb-8 text-center">Your Saved Outfits</h1>

    <?php if (empty($outfits)): ?>
      <p class="text-center text-gray-600">No outfits saved yet.</p>
    <?php else: ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($outfits as $outfit): ?>
          <div class="bg-white rounded shadow p-4 relative">
            <h2 class="text-2xl font-semibold mb-4"><?= htmlspecialchars($outfit['outfit_name']) ?></h2>

            <?php
              $itemIds = json_decode($outfit['items'], true);
              $items = getItemsByIds(new mysqli("localhost","root","","users", 3307), $itemIds);
            ?>

            <div class="flex flex-wrap gap-3 mb-4">
              <?php if (empty($items)): ?>
                <p class="text-gray-500">No items found for this outfit.</p>
              <?php else: ?>
                <?php foreach ($items as $item): ?>
                  <div class="w-20 h-24 border rounded overflow-hidden">
                    <img src="<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="object-cover w-full h-full" />
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>

            <a href="?delete_id=<?= $outfit['id'] ?>" onclick="return confirm('Delete this outfit?');" class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
