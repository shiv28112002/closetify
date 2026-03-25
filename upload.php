<?php
session_start();

// Show errors for debugging (remove on production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in. <a href='login.php'>Login here</a>");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    // DB connection
    $conn = new mysqli("localhost", "root", "", "users", 3307);
    if ($conn->connect_error) {
        die("DB connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $color = $_POST['color'];
    $season = $_POST['season'];
    $occasion = $_POST['occasion'];

    // Create uploads folder if not exists
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $imageName = basename($_FILES["image"]["name"]);
    $targetFile = $uploadDir . uniqid() . "_" . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO items (name, color, occasion, season, user_id, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $name, $color, $occasion, $season, $user_id, $targetFile);

        if ($stmt->execute()) {
            $message = "Item uploaded successfully!";
        } else {
            $message = "DB error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Image upload failed.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-gradient-to-t from-sky-100 to-slate-50">
<?php include'navi.php'?>
  <div class="bg-white p-8 rounded shadow-md w-full max-w-md mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Add Clothing Item</h1>

    <?php if ($message): ?>
      <div class="mb-4 p-3 text-center rounded <?= strpos($message, 'success') !== false ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="space-y-5">
      <div>
        <label class="block font-semibold mb-1">Item Name</label>
        <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div>
        <label class="block font-semibold mb-1">Color</label>
        <input type="text" name="color" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div>
        <label class="block font-semibold mb-1">Season</label>
        <select name="season" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="" disabled selected>Select season</option>
          <option value="Summer">Summer</option>
          <option value="Winter">Winter</option>
          <option value="Spring">Spring</option>
          <option value="Autumn">Autumn</option>
        </select>
      </div>

      <div>
        <label class="block font-semibold mb-1">Occasion</label>
        <select name="occasion" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="" disabled selected>Select occasion</option>
          <option value="Casual">Casual</option>
          <option value="Formal">Formal</option>
          <option value="Party">Party</option>
          <option value="Workout">Workout</option>
        </select>
      </div>

      <div>
        <label class="block font-semibold mb-1">Select Image</label>
        <input type="file" name="image" accept="image/*" required class="w-full" />
      </div>

      <div class="text-center">
        <button type="submit" class="bg-blue-600 text-white rounded px-6 py-2 hover:bg-blue-700 transition">
          Upload
        </button>
      </div>
    </form>
    <div class="mt-6 grid grid-cols-3 gap-6" id="suggestionsContainer"></div>

    <a href="gallery.php" class="mt-6 inline-block text-blue-600 hover:underline">View All Cloths</a><br/>
    
  </div>
  </div>

</body>
</html>
