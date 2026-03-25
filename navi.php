<!-- upper navigation bar -->
<!--Nav-->
    <nav id="header" class="fixed w-full z-80 top-0 text-white py-3 px-4 flex flex-wrap items-center justify-between backdrop-blur-70 bg:black-90 ">
   
        <div class=" flex items-center">
          <a class=" text-teal-400 ml-3 font-bold text-2xl lg:text-4xl" href="landingpage.php">
            CLOSETIFY
          </a>
        </div>
       <div class="block lg:hidden pr-4">
          <button id="nav-toggle" class="flex items-center p-1 text-teal-300 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
          <ul class="list-reset lg:flex justify-end flex-1 items-center">
            <li class="mr-3">
              <a class="inline-block text-teal-400 md:text-lg text-base hover:text-teal-300 hover:text-underline py-2 px-4" href="homepage.php">Home</a>
            </li>
            <li class="mr-3">
              <a class="inline-block text-teal-400 md:text-lg text-base hover:text-teal-300 hover:text-underline py-2 px-4" href="closet.php">Wardrobe</a>
            </li>
            <li class="mr-3">
              <a class="inline-block text-teal-400 md:text-lg text-base hover:text-teal-300 hover:text-underline py-2 px-4" href="suggestion.php">Suggestion</a>
            </li>
            <li class="mr-3">
              <a class="inline-block text-teal-400 md:text-lg text-base hover:text-teal-300 hover:text-underline py-2 px-4" href="tryon.php">Try-on</a>
            </li>
            <li class="mr-3">
              <a class="inline-block text-teal-400 md:text-lg text-base hover:text-teal-300 hover:text-underline py-2 px-4" href="color.php">Style-lab</a>
            </li>
            <li class="mr-3">
              <a class="inline-block text-teal-400 md:text-lg text-base hover:text-teal-300 hover:text-underline py-2 px-4" href="logout.php">Logout</a>
            </li>
            
          </ul>
        </div>
    </nav>
     <script>

      var navMenuDiv = document.getElementById("nav-content");
      var navMenu = document.getElementById("nav-toggle");

      document.onclick = check;
      function check(e) {
        var target = (e && e.target) || (event && event.srcElement);

        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
          // click NOT on the menu
          if (checkParent(target, navMenu)) {
            // click on the link
            if (navMenuDiv.classList.contains("hidden")) {
              navMenuDiv.classList.remove("hidden");
            } else {
              navMenuDiv.classList.add("hidden");
            }
          } else {
            // click both outside link and outside menu, hide menu
            navMenuDiv.classList.add("hidden");
          }
        }
      }
      function checkParent(t, elm) {
        while (t.parentNode) {
          if (t == elm) {
            return true;
          }
          t = t.parentNode;
        }
        return false;
      }
    </script>

        </aside>
        <!-- Bottom Navigation (Mobile Only) -->
  <nav class="fixed bottom-2 left-1/2 transform -translate-x-1/2 w-full max-w-full bg-gray-100 shadow-xl  border-gray-200 rounded-3xl md:hidden z-50">
 <div class="shadow-md flex justify-around items-center h-16 z-50 relative">
  <!-- Closet -->
  <a href="closet.php" class="flex flex-col items-center text-gray-700 text-xs rounded-full  ">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" 
     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path stroke-linecap="round" stroke-linejoin="round" 
        d="M4 3h16v18H4V3zm8 0v18M8 7h.01M16 7h.01" />
</svg>

   <span>Wardrobe</span>
  </a>

  <!-- suggestion -->
  <a href="suggestion.php" class="flex flex-col items-center text-gray-700 text-xs  ">
     <svg xmlns="http://www.w3.org/2000/svg" class=" h-6 w-6 mb-1 " viewBox="0 0 512 512">
        <rect width="384" height="256" x="64" y="176" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" rx="28.87" ry="28.87"/><path fill="currentColor" stroke="currentColor"
         stroke-linecap="round" stroke-miterlimit="10" stroke-width="38" d="M144 80h224m-256 48h288"/></svg>
                      
    </svg>
    <span>Suggestion</span>
  </a>

  <!-- home -->
  <a  href="homepage.php" class="flex flex-col items-center text-gray-700 text-xs ">
    <div class="bg-black text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg ">
     <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
       viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 9.75L12 3l9 6.75V20a1 1 0 01-1 1h-5a1 1 0 01-1-1v-5H10v5a1 1 0 01-1 1H4a1 1 0 01-1-1V9.75z"/>
  </svg>
    </div>
  </a>

  <!-- try-on -->
  <a href="tryon.php" class="flex flex-col items-center text-gray-700 text-xs ">
  <svg xmlns="http://www.w3.org/2000/svg" class=" h-7 w-7 mb-1" viewBox="0 0 24 24">
    <path fill="currentColor"
      d="M18.41 3.41L16 4.5l2.41 1.09L19.5 8l1.1-2.41L23 4.5l-2.4-1.09L19.5 1M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10c0-1.47-.33-2.87-.9-4.13l-1.24 2.72c.08.46.14.91.14 1.41c0 4.43-3.57 8-8 8s-8-3.57-8-8v-.13a10 10 0 0 0 5.74-5.56A10 10 0 0 0 17.5 10a10 10 0 0 0 1.33-.09l-1.48-3.26L12.6 4.5l3.53-1.6C14.87 2.33 13.47 2 12 2m-3 9.75A1.25 1.25 0 0 0 7.75 13A1.25 1.25 0 0 0 9 14.25A1.25 1.25 0 0 0 10.25 13A1.25 1.25 0 0 0 9 11.75m6 0A1.25 1.25 0 0 0 13.75 13A1.25 1.25 0 0 0 15 14.25A1.25 1.25 0 0 0 16.25 13A1.25 1.25 0 0 0 15 11.75Z"/></svg>                     
<span>Try-on</span>
  </a>

  <!-- style-lab -->
  <a href="color.php" class="flex flex-col items-center text-gray-700 text-xs ">
    <svg xmlns="http://www.w3.org/2000/svg" class=" h-7 w-7 mb-1 "  viewBox="0 0 25 24">
        <path fill="currentColor" d="m20.887 2.27l-1.568.78l1.569.782l.78 1.569l.781-1.57l1.57-.78l-1.57-.781l-.78-1.569l-.782 1.569ZM7.96 1.515l1.097 2.204l2.204 1.097l-2.204 1.097L7.96 8.117L6.863 5.913L4.659 4.816l2.204-1.097L7.96 1.515Zm9.28 1.887l5.148 5.149L7.298 23.64L2.15 18.491L17.24 3.402Zm-2.005 4.833l2.32 2.32l2.005-2.004l-2.32-2.32l-2.005 2.004Zm.906 3.735l-2.32-2.32l-8.842 8.841l2.32 2.32l8.842-8.841Z"/></svg>
                           
    <span>Style-Lab</span>
  </a>
</div>
  
  </nav>
          <script>
        // Dropdown functionality
        document.querySelectorAll('button[aria-controls]').forEach(button => {
            button.addEventListener('click', () => {
                const isExpanded = button.getAttribute('aria-expanded') === 'true';
                const dropdownContent = document.getElementById(button.getAttribute('aria-controls'));
                
                button.setAttribute('aria-expanded', !isExpanded);
                dropdownContent.classList.toggle('hidden');
                button.querySelector('svg:last-child').classList.toggle('rotate-180');
            });
        });
    </script>