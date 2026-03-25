<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-cover bg-center min-h-screen" style="background-image: url('./assets/Picsart_25-03-25_21-44-51-776.jpg');">

  <!-- Overlay to darken background for better readability -->
  <div class="absolute inset-0"></div>

  <div class="relative z-10 flex flex-col min-h-screen">
    <?php include 'navi.php'; ?>

    <main class="flex-1 p-6 md:p-12">
      <!-- Welcome Section -->
      <div class="bg-white bg-opacity-90 rounded-2xl mt-8 shadow-lg p-6 md:p-10 mb-10 max-w-3xl mx-auto animate-fade-in">
        <div class="flex items-center space-x-4">
          <img src="./assets/user (2).png" alt="User" class="w-14 h-14 rounded-full border-2 border-indigo-600 shadow-md">
          <div>
            <h1 class="text-2xl md:text-3xl font-bold text-indigo-800">
              Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>
            </h1>
            <p class="text-indigo-600 text-md md:text-lg mt-1">Welcome back to Closetify!</p>
          </div>
        </div>
      </div>

      <!-- Dashboard Cards -->
      <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-2">
        <!-- Wardrobe -->
        <a href="closet.php" class="group p-6 rounded-2xl bg-white bg-opacity-90 shadow-xl transition hover:-translate-y-1 hover:shadow-2xl hover:bg-indigo-50">
          <div class="flex items-center space-x-4">
            <svg class="w-10 h-10 text-indigo-600 group-hover:text-indigo-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 3h16v18H4V3zm8 0v18M8 7h.01M16 7h.01" />
            </svg>
            <div>
              <h2 class="text-xl font-semibold text-indigo-900">Wardrobe</h2>
              <p class="text-sm text-indigo-600">Manage your outfits</p>
            </div>
          </div>
        </a>

        <!-- Suggestion -->
        <a href="suggestion.php" class="group p-6 rounded-2xl bg-white bg-opacity-90 shadow-xl transition hover:-translate-y-1 hover:shadow-2xl hover:bg-indigo-50">
          <div class="flex items-center space-x-4">
             <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-600 h-10 w-10 mr-3 " viewBox="0 0 512 512"><rect width="384" height="256" x="64" y="176" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" rx="28.87" ry="28.87"/><path fill="currentColor" stroke="currentColor"
                        stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M144 80h224m-256 48h288"/></svg> 
            <div>
              <h2 class="text-xl font-semibold text-indigo-900">Suggestions</h2>
              <p class="text-sm text-indigo-600">Get outfit ideas</p>
            </div>
          </div>
        </a>

        <!-- Sell & Buy -->
        <a href="tryon.php" class="group p-6 rounded-2xl bg-white bg-opacity-90 shadow-xl transition hover:-translate-y-1 hover:shadow-2xl hover:bg-indigo-50">
          <div class="flex items-center space-x-4">
            <svg class="w-11 h-11 text-indigo-600 group-hover:text-indigo-800" fill="currentColor" viewBox="0 0 24 24">
              <path d="M18.41 3.41L16 4.5l2.41 1.09L19.5 8l1.1-2.41L23 4.5l-2.4-1.09L19.5 1M12 2C6.5 2 2 6.5 2 12s4.5 10 
              10 10s10-4.5 10-10c0-1.47-.33-2.87-.9-4.13l-1.24 2.72c.08.46.14.91.14 1.41c0 4.43-3.57 8-8 8s-8-3.57-8-8v-.13
              a10 10 0 0 0 5.74-5.56A10 10 0 0 0 17.5 10a10 10 0 0 0 1.33-.09l-1.48-3.26L12.6 4.5l3.53-1.6C14.87 2.33 
              13.47 2 12 2m-3 9.75A1.25 1.25 0 0 0 7.75 13A1.25 1.25 0 0 0 9 14.25A1.25 1.25 0 0 0 10.25 13A1.25 1.25 0 0 0 9 11.75m6 0A1.25 1.25 0 0 0 13.75 13A1.25 1.25 0 0 0 15 14.25A1.25 1.25 0 0 0 16.25 13A1.25 1.25 0 0 0 15 11.75Z"/>
            </svg>
            <div>
              <h2 class="text-xl font-semibold text-indigo-900">Try-on </h2>
              <p class="text-sm text-indigo-600">Try-on your clothes virtually</p>
            </div>
          </div>
        </a>

        <!-- Style Lab -->
        <a href="color.php" class="group p-6 rounded-2xl bg-white bg-opacity-90 shadow-xl transition hover:-translate-y-1 hover:shadow-2xl hover:bg-indigo-50">
          <div class="flex items-center space-x-4">
            <svg class="w-11 h-11 text-indigo-600 group-hover:text-indigo-800" fill="currentColor" viewBox="0 0 25 24">
              <path d="m20.887 2.27l-1.568.78l1.569.782l.78 1.569l.781-1.57l1.57-.78l-1.57-.781l-.78-1.569l-.782 1.569ZM7.96 1.515l1.097 2.204l2.204 1.097l-2.204 1.097L7.96 8.117L6.863 5.913L4.659 4.816l2.204-1.097L7.96 1.515Zm9.28 1.887l5.148 5.149L7.298 23.64L2.15 18.491L17.24 3.402Zm-2.005 4.833l2.32 2.32l2.005-2.004l-2.32-2.32l-2.005 2.004Zm.906 3.735l-2.32-2.32l-8.842 8.841l2.32 2.32l8.842-8.841Z"/>
            </svg>
            <div>
              <h2 class="text-xl font-semibold text-indigo-900">Style Lab</h2>
              <p class="text-sm text-indigo-600">Explore your style</p>
            </div>
          </div>
        </a>
      </div>
    </main>
  </div>

</body>
</html>
