<?php
// seasonal_color_analyzer.php

// Define seasonal palettes
$seasonPalettes = [
    'Spring' => [[255,223,186],[255,239,186],[255,204,153],[255,255,204]],
    'Summer' => [[173,216,230],[224,192,192],[192,192,224],[224,224,224]],
    'Autumn' => [[153,76,0],[204,102,0],[255,153,51],[204,153,102]],
    'Winter' => [[51,51,153],[0,51,102],[153,204,255],[102,102,102]]
];

// Function to determine closest season
function closestSeason($rgb, $palettes) {
    $minDist = PHP_INT_MAX;
    $best = null;
    foreach ($palettes as $season => $colors) {
        $dist = 0;
        foreach ($colors as $c) {
            $dist += sqrt(pow($rgb[0]-$c[0],2) + pow($rgb[1]-$c[1],2) + pow($rgb[2]-$c[2],2));
        }
        if ($dist < $minDist) {
            $minDist = $dist;
            $best = $season;
        }
    }
    return $best;
}

// Handle POST from canvas
$season = null;
$selectedRGB = null;
$suggestedPalette = null;

if (isset($_POST['r'], $_POST['g'], $_POST['b'])) {
    $selectedRGB = [ (int)$_POST['r'], (int)$_POST['g'], (int)$_POST['b'] ];
    $season = closestSeason($selectedRGB, $seasonPalettes);
    $suggestedPalette = $seasonPalettes[$season];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Style-lab</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen"> 
   <?php include'navi.php'?>
  <div class=" flex items-center justify-center p-6 bg-cover bg-center min-h-screen" style="background-image: url('./assets/Picsart_25-03-25_21-44-51-776.jpg');">
   
  <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-xl w-full">

    <h1 class="text-3xl font-extrabold text-center mb-6 text-gray-700"> Seasonal Color Analyzer</h1>

    <!-- Image upload and canvas -->
    <div class="space-y-4">
      <input type="file" id="upload" accept="image/*"
        class="block w-full text-gray-700 file:bg-purple-600 file:text-white file:px-4 file:py-2 rounded-full" />
      <canvas id="canvas" class="hidden max-w-full rounded-lg shadow border"></canvas>
      <button id="analyzeBtn"
        class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg font-semibold transition">Analyze
        Center Pixel</button>
    </div>

    <!-- Hidden RGB POST form -->
    <form id="colorForm" method="post" class="hidden">
      <input type="hidden" name="r" id="r">
      <input type="hidden" name="g" id="g">
      <input type="hidden" name="b" id="b">
    </form>

    <!-- Display result -->
    <?php if ($season): ?>
    <div class="mt-8 text-center">
      <h2 class="text-2xl font-bold">Season: <span class="text-purple-700"><?php echo htmlspecialchars($season); ?></span></h2>
      <p class="mt-2 text-gray-500 text-sm">Sampled RGB: <?php echo implode(', ', $selectedRGB); ?></p>
      <div class="mt-4 flex justify-center gap-4">
        <?php foreach ($suggestedPalette as $col): ?>
        <div class="w-14 h-14 rounded-full border shadow-sm" style="background-color: rgb(<?php echo implode(',', $col); ?>)"></div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
        </div>
  <script>
    const upload = document.getElementById('upload');
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const analyzeBtn = document.getElementById('analyzeBtn');

    let imgDataURL;
    upload.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = () => {
        imgDataURL = reader.result;
        const img = new Image();
        img.src = imgDataURL;
        img.onload = () => {
          canvas.width = img.width;
          canvas.height = img.height;
          ctx.drawImage(img, 0, 0);
          canvas.classList.remove('hidden');
        };
      };
      reader.readAsDataURL(file);
    });

    analyzeBtn.addEventListener('click', () => {
      if (!imgDataURL) return alert('Please upload an image first.');
      const x = Math.floor(canvas.width / 2);
      const y = Math.floor(canvas.height / 2);
      const pixel = ctx.getImageData(x, y, 1, 1).data;
      document.getElementById('r').value = pixel[0];
      document.getElementById('g').value = pixel[1];
      document.getElementById('b').value = pixel[2];
      document.getElementById('colorForm').submit();
    });
  </script>
</body>
</html>
