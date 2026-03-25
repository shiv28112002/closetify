<?php
session_start();

// Handle file uploads
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    if (isset($_FILES['userImage']) && $_FILES['userImage']['error'] === 0) {
        move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadDir . 'user.jpg');
    }

    if (isset($_FILES['clothImage']) && $_FILES['clothImage']['error'] === 0) {
        move_uploaded_file($_FILES['clothImage']['tmp_name'], $uploadDir . 'clothing.png');
    }

    $_SESSION['show_preview'] = true;
    header('Location: tryon.php');
    exit;
}

$showPreview = false;
if (isset($_SESSION['show_preview']) && $_SESSION['show_preview'] === true) {
    $showPreview = file_exists('uploads/user.jpg') && file_exists('uploads/clothing.png');
    unset($_SESSION['show_preview']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title> Try-On</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <style>
    #previewArea {
      position: relative;
      max-width: 350px;
      margin: 0 auto;
      border-radius: 1rem;
      overflow: hidden;
      background: white;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      user-select: none;
      height: 450px; /* fixed height to contain images */
    }
    #userPhoto {
      width: 100%;
      display: block;
      border-radius: 1rem;
      height: 100%;
      object-fit: contain;
      user-select: none;
      pointer-events: none;
    }
    #clothOverlay {
      position: absolute;
      top: 150px;
      left: 140px;
      width: 140px;
      cursor: move;
      overflow: hidden;
      user-select: none;
    }
    #clothOverlay img {
      width: 100%;
      height: auto;
      pointer-events: none;
      user-select: none;
      display: block;
    }
    #resizeHandle {
      position: absolute;
      right: 0;
      bottom: 0;
      width: 20px;
      height: 20px;
      background: rgba(0,0,0,0.5);
      cursor: nwse-resize;
      border-radius: 4px;
      user-select: none;
    }
  </style>
</head>
<body>
  <?php include'navi.php'?>
<div  class=" min-h-screen flex flex-col items-center p-6 bg-cover bg-center" style="background-image: url('./assets/Picsart_25-03-25_21-44-51-776.jpg');">
  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mt-20">
    <h1 class="text-4xl font-extrabold text-center mb-8 text-gray-800"> Virtual Try-On</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-6">
      <div>
        <label class="block font-semibold text-gray-700 mb-2">Upload Your Photo</label>
        <input required type="file" name="userImage" accept="image/*" class="file:bg-blue-600 file:text-white file:px-5 file:py-2 file:rounded-full w-full" />
      </div>
      <div>
        <label class="block font-semibold text-gray-700 mb-2">Upload Clothing Image</label>
        <input required type="file" name="clothImage" accept="image/png" class="file:bg-purple-600 file:text-white file:px-5 file:py-2 file:rounded-full w-full" />
      </div>
      <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg w-full transition">Try It On</button>
    </form>

    <?php if ($showPreview): ?>
      <div class="mt-10 text-center">
        <h2 class="text-2xl font-semibold mb-4">Preview</h2>
        <div id="previewArea" tabindex="0" aria-label="Virtual try-on preview area">
          <img id="userPhoto" src="uploads/user.jpg" alt="User photo" />
          <div id="clothOverlay" role="img" aria-label="Clothing overlay">
            <img src="uploads/clothing.png" alt="Clothing" draggable="false" />
            <div id="resizeHandle" aria-hidden="true"></div>
          </div>
        </div>
        <button id="resetBtn" class="mt-6 bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg transition">Reset</button>
      </div>
    <?php endif; ?>
  </div>
    </div>

<script>
  const clothOverlay = document.getElementById('clothOverlay');
  const resizeHandle = document.getElementById('resizeHandle');
  const resetBtn = document.getElementById('resetBtn');

  if (clothOverlay && resizeHandle && resetBtn) {
    let isDragging = false;
    let isResizing = false;
    let offsetX, offsetY;
    let startWidth, startHeight, startX, startY;

    // Drag start
    clothOverlay.addEventListener('mousedown', (e) => {
      if (e.target === resizeHandle) return; // ignore if resizing

      isDragging = true;
      offsetX = e.clientX - clothOverlay.offsetLeft;
      offsetY = e.clientY - clothOverlay.offsetTop;

      clothOverlay.style.transform = 'none'; // clear transform for consistent positioning
      e.preventDefault();
    });

    // Drag move
    window.addEventListener('mousemove', (e) => {
      if (isDragging) {
        let newLeft = e.clientX - offsetX;
        let newTop = e.clientY - offsetY;

        // Boundaries to stay within preview area
        const preview = document.getElementById('previewArea');
        const maxLeft = preview.clientWidth - clothOverlay.offsetWidth;
        const maxTop = preview.clientHeight - clothOverlay.offsetHeight;

        if (newLeft < 0) newLeft = 0;
        if (newTop < 0) newTop = 0;
        if (newLeft > maxLeft) newLeft = maxLeft;
        if (newTop > maxTop) newTop = maxTop;

        clothOverlay.style.left = newLeft + 'px';
        clothOverlay.style.top = newTop + 'px';
      }

      if (isResizing) {
        const dx = e.clientX - startX;
        const dy = e.clientY - startY;

        let newWidth = startWidth + dx;
        let newHeight = startHeight + dy;

        // Minimum size limits
        newWidth = Math.max(newWidth, 50);
        newHeight = Math.max(newHeight, 50);

        // Keep aspect ratio (optional)
        const aspectRatio = startWidth / startHeight;
        if (newWidth / newHeight > aspectRatio) {
          newHeight = newWidth / aspectRatio;
        } else {
          newWidth = newHeight * aspectRatio;
        }

        clothOverlay.style.width = newWidth + 'px';
        clothOverlay.style.height = newHeight + 'px';
      }
    });

    // Drag/resize end
    window.addEventListener('mouseup', () => {
      isDragging = false;
      isResizing = false;
    });

    // Resize start
    resizeHandle.addEventListener('mousedown', (e) => {
      e.stopPropagation();
      isResizing = true;
      startWidth = clothOverlay.offsetWidth;
      startHeight = clothOverlay.offsetHeight;
      startX = e.clientX;
      startY = e.clientY;
      e.preventDefault();
    });

    // Reset button
    resetBtn.addEventListener('click', () => {
      clothOverlay.style.top = '150px';
      clothOverlay.style.left = '140px';
      clothOverlay.style.width = '140px';
      clothOverlay.style.height = 'auto';
      clothOverlay.style.transform = 'none';
    });
  }
</script>

</body>
</html>
