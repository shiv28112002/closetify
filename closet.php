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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Wardrobe</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body  class="min-h-screen bg-gradient-to-t from-sky-100 to-slate-50 bg-cover bg-center " style="background-image: url('./assets/Picsart_25-03-25_21-44-51-776.jpg');" >
 <?php include'navi.php'?>
<div  class=" p-5 mt-20">
 <!-- Profile -->
     <div class="flex items-center space-x-4 p-4 ">
      <div class="flex-1 bg-indigo-100 border-indigo-200 rounded-xl p-3 animate-fade-in">
                    <div class="flex items-center space-x-4">
                       <div class="w-10 h-10 md:h-10 rounded-full bg-gray-300"><img src="./assets/user (2).png"></div>
                          <div>
                            <div class="text-base  md:text-2xl font-semibold"> <?php echo htmlspecialchars( $_SESSION['username']);  ?>
                        </div>
        
                        </div>
                     </div>
                    </div> 
    </div>

  <!-- Closet Section -->
  <div class="p-4">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
      <!-- Add Item -->
      <a href="upload.php"class="w-full aspect-square border-4 border-gray-500   rounded-2xl flex items-center justify-center text-3xl text-rose-500 text-4xl bg-white">
        +</a>
      
      <!-- Item -->
      <a href="gallery.php" class="w-full aspect-square border-4 border-gray-500 rounded-2xl p-2  flex items-center justify-center text-rose-500 text-xl bg-white">
       Items
      </a>

     <a href="looks.php" class="w-full aspect-square border-4 border-gray-500  rounded-2xl flex items-center justify-center text-center text-rose-500 text-xl bg-white ">
        Looks
      </a>
      <a href="outfits.php" class="w-full aspect-square  border-4 border-gray-500  rounded-2xl flex items-center justify-center text-center text-rose-500 text-xl bg-white">
        Saved Outfits
      </a>
    </div>
  </div>
</div>
</body>
</html>
