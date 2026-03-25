<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please <a href='login.php'>login</a> first.");
}

$conn = new mysqli("localhost", "root", "", "users",3307);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$suggestions = [];
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $season = $_POST['season'] ?? '';
    $occasion = $_POST['occasion'] ?? '';

    if ($season && $occasion) {
        $stmt = $conn->prepare("SELECT name, color, occasion, season, image_path FROM items WHERE user_id = ? AND season = ? AND occasion = ?");
        $stmt->bind_param("iss", $user_id, $season, $occasion);
        $stmt->execute();
        $result = $stmt->get_result();
        $suggestions = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $error = "Please select both season and occasion.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Outfit Suggestions</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class=" min-h-screen font-sans bg-cover bg-center " style="background-image: url('./assets/Picsart_25-03-25_21-44-51-776.jpg');">

  <?php include 'navi.php'; ?>

  <div class="max-w-5xl mx-auto px-4 sm:px-8 py-16">
    <div class="bg-white/90 backdrop-blur-xs shadow-xl rounded-3xl p-10 border border-gray-200 mt-10">
      <h1 class="text-4xl font-bold text-center mb-10 text-gray-800">🧥 Outfit Suggestions</h1>

      <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10 ">
        <div>
          <label class="block mb-2 text-gray-700 font-medium">Season</label>
          <select name="season" required class="w-full px-4 py-2 rounded-lg border border-gray-400 focus:ring-2 focus:ring-blue-400">
            <option value="" disabled <?php echo !isset($season) ? 'selected' : ''; ?>>Select season</option>
            <option value="Summer" <?php echo (isset($season) && $season == 'Summer') ? 'selected' : ''; ?>>Summer</option>
            <option value="Winter" <?php echo (isset($season) && $season == 'Winter') ? 'selected' : ''; ?>>Winter</option>
            <option value="Spring" <?php echo (isset($season) && $season == 'Spring') ? 'selected' : ''; ?>>Spring</option>
            <option value="Autumn" <?php echo (isset($season) && $season == 'Autumn') ? 'selected' : ''; ?>>Autumn</option>
          </select>
        </div>

        <div>
          <label class="block mb-2 text-gray-700 font-medium">Occasion</label>
          <select name="occasion" required class="w-full px-4 py-2 rounded-lg border border-gray-400 focus:ring-2 focus:ring-blue-400">
            <option value="" disabled <?php echo !isset($occasion) ? 'selected' : ''; ?>>Select occasion</option>
            <option value="Casual" <?php echo (isset($occasion) && $occasion == 'Casual') ? 'selected' : ''; ?>>Casual</option>
            <option value="Formal" <?php echo (isset($occasion) && $occasion == 'Formal') ? 'selected' : ''; ?>>Formal</option>
            <option value="Party" <?php echo (isset($occasion) && $occasion == 'Party') ? 'selected' : ''; ?>>Party</option>
            <option value="Workout" <?php echo (isset($occasion) && $occasion == 'Workout') ? 'selected' : ''; ?>>Workout</option>
          </select>
        </div>

        <div class="md:col-span-2 text-center">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2 rounded-lg transition duration-200">
            🔍 Get Suggestions
          </button>
        </div>
      </form>

      <?php if ($error): ?>
        <div class="text-red-600 text-center font-medium mb-6"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <?php if ($suggestions): ?>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Suggestions for 
          <span class="text-blue-600"><?php echo htmlspecialchars($season); ?></span> / 
          <span class="text-purple-600"><?php echo htmlspecialchars($occasion); ?></span>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <?php foreach ($suggestions as $item): ?>
            <div class="bg-white border rounded-2xl shadow-lg p-4 hover:shadow-2xl transition duration-200">
              <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-full h-52 object-cover rounded-xl mb-4" />
              <div class="text-center">
                <h3 class="font-bold text-lg text-gray-700"><?php echo htmlspecialchars($item['name']); ?></h3>
                <p class="text-sm text-gray-500"><?php echo htmlspecialchars($item['color']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p class="text-center text-gray-600 mt-6">No matching items found.</p>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
