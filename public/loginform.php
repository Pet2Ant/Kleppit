<?php
session_start();
include '../components/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Kleppit</title>
  <link rel="icon" href="../assets/kleppit-website-favicon-color.png" />
  <link rel="stylesheet" href="./css/style.css">
</head>

<body class="bg-zinc-900">
      <!-- Loader -->
      <div id="loader" class="loader fixed top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">

        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-red-500"></div>
     </div>
    <!-- Nav Bar -->
    <?php
      $navbar = new Navbar();
      $navbar->genereElement();
    ?>

     <div class="py-12 mt-12">
    <div class="container mx-auto">
      <div class="flex w-960 mx-auto">
        <div class="max-w-sm mx-auto px-6 ">
          <img src="../assets/kleppit-high-resolution-logo-color-on-transparent-background.png" alt="logo"
            class="h-22 py-3">
          <div class="">
            <div class="w-full relative ">
              <div class="mt-6 ">
                <div class="text-center font-semibold text-3xl text-red-500">
                  Log in
                </div>
                <form action="../login.php" method="post" class="mt-8">
                  <div class="mx-auto max-w-lg ">
                    <div class="py-1">
                      <span class="px-1 text-md text-red-500">Email/Username</span>
                      <input placeholder="Email/Username..." type="text" name="emailorusername"
                        class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-red-600 focus:outline-none">
                    </div>
                  </div>
                  <div class="py-1">
                    <span class="px-1 text-md text-red-500">Password</span>
                    <input placeholder="Password..." name="pwd" type="password"
                      class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-red-600 focus:outline-none">
                  </div>
                  <div class="flex justify-start">
                <a href="./forgotPassword.html"
                  class="italic text-sm font-semibold text-red-700 transition duration-300 ease-in-out hover:text-red-700 px-1 py-2">
                  Forgot Password?
                </a>
                
              </div>
              <ul>
                <li class="flex items-center py-1">
                  <p class="text-sm text-red-700">Not a Kleppitor?</p>
                  <a href="./signupform.php"
                    class="underline text-sm text-red-700 font-bold transition duration-300 ease-in-out hover:text-red-700 px-1 py-1">Sign
                    up!</a>
                </li>
              </ul>
                  <button  type="submit" name="submit"
                class="w-full my-2 text-md font-bold bg-gray-300 transition duration-500 ease-in-out hover:bg-gray-400 rounded-full p-1">Log
                in
              </button>
                </form>
              </div>              
            </div>
            <div>
                  
                  <?php
                      $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
                      if(strpos($fullUrl,"error=checkdberror") == true)
                        {
                          echo "<p style='color:red'>Could not connect to the database.
                          Check your connection</p>";
                        }
                        if(strpos($fullUrl,"error=wrongpassword") == true)
                        {
                          echo "<p style='color:red'>Wrong password.</p>";
                        }
                        if(strpos($fullUrl,"error=usernotfound") == true)
                        {
                          echo "<p style='color:red'>Username not found.</p>";
                        }
                        if(strpos($fullUrl,"error=emptyinput") == true)
                        {
                          echo "<p style='color:red'>You need to fill all of the fields.</p>";
                        }
                        
                  ?>
                  </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  </div>
  <script src="./main.js"></script>
</body>

</html>