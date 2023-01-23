

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kleppit</title>
    <link rel="icon" href="../assets/kleppit-website-favicon-color.png" />
    <link rel="stylesheet" href="./css/style.css">
  </head>
  

  <body class="bg-zinc-900">
        <!-- Loader -->
        <div id="loader" class="loader fixed top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
          <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-[#ff4057]"></div>
       </div>
    <div class="py-12 mt-12">
      <div class="container mx-auto">
        <div class="flex w-960 mx-auto">
          <div class="max-w-sm mx-auto px-6">
            <img
              src="../assets/kleppit-high-resolution-logo-color-on-transparent-background.png"
              alt="logo"
              class="h-22 py-3"
            />
            <div class="">
              <div class="w-full relative">
                <div class="mt-6">
                  <div
                    class="text-center font-semibold text-3xl text-[#ff4057]"
                  >
                    Sign up
                  </div>
                  <form action="../signup.php"  method="post" class="mt-8">
                    <div class="mx-auto max-w-lg">
                      <div class="py-1">
                        <span class="px-1 text-md text-[#ff4057]"
                          >Username</span
                        >
                        <input
                          placeholder="Username..."
                          name="username"
                          type="text"
                          class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-[#ff4957] focus:outline-none"
                        />
                       
                      </div>
                      <div class="py-1">
                        <span class="px-1 text-md text-[#ff4057]">Email</span>
                        <input
                          placeholder="Email Address..."
                          name="email"
                          type="email"
                          class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-[#ff4957] focus:outline-none"
                        />
                       
                      </div>
                    </div>
                    <div class="py-1">
                      <span class="px-1 text-md text-[#ff4057]">Password</span>
                      <input
                        placeholder="Password..."
                        type="password"
                        name="password"
                        class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-[#ff4957] focus:outline-none"
                      />
                     
                    </div>
                    <div class="py-1">
                      <span class="px-1 text-md text-[#ff4057]"
                        >Confirm Password</span
                      >
                      <input
                        placeholder="Confirm Password..."
                        type="password"
                        name="confirm"
                        class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-[#ff4957] focus:outline-none"
                      />
                      <div class="error-text"></div>
                    </div>
                    
                    <button type="submit" name="submit"
                  class="w-full text-md font-bold bg-gray-300 transition duration-500 ease-in-out hover:bg-gray-400 rounded-full p-1"
                >
                  Register
                </button>
                  </form>
                </div>
                <div class="flex justify-start mt-3 ml-4 p-1">
                <?php
                      $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                      if(strpos($fullUrl,"signup=empty") == true)
                        {
                          echo "<p style='color:red'> You did not fill all the fields</p>";

                        }
                      if(strpos($fullUrl,"signup=invalidusername") == true)
                        {
                          echo "<p style='color:red'> Username is not valid</p>";
                          
                        }
                      if(strpos($fullUrl,"signup=invalidemail") == true)
                        {
                          echo "<p style='color:red'> Email is not valid</p>";
                          
                        }
                      if(strpos($fullUrl,"signup=invallidpassword") == true)
                        {
                        echo "<p style='color:red'> Password is not 
                        valid.Password must contain at 
                        least one capital letter (A,B,C...),
                        one number (1,2,3...) & one special
                        character (#,?,%...)</p>";
                    
                        }
                      if(strpos($fullUrl,"signup=passwordDoesntMatch") == true)
                        {
                          echo "<p style='color:red'> Passwords did not match</p>";
                    
                        }
                      if(strpos($fullUrl,"signup=alreadyexists") == true) 
                        {
                          echo "<p style='color:red'> Username or email already in use</p>";
                        }
                        if(strpos($fullUrl,"signup=checkdberror") == true) 
                        {
                          echo "<p style='color:red'> Could not connect to the database</p>";
                        }

                ?>
                </div>
                <div class="flex justify-start">
                  <label class="text-gray-400 font-bold my-4 flex items-center">
                    <input
                      class="leading-loose text-pink-600 top-0"
                      type="checkbox"
                    />
                    <span class="ml-2 text-sm py-2 text-gray-400 text-left"
                      >I Accept
                      <a
                        href="./userAgreement.html"
                        class="font-semibold text-[#ff4057] transition duration-300 ease-in-out hover:text-red-700 border-b-2 border-[#ff4057] hover:border-red-700"
                      >
                        Kleppit's User Agreement </a
                      >and
                      <a
                        href="./privacyPolicy.html"
                        class="font-semibold text-[#ff4057] transition duration-300 ease-in-out hover:text-red-700 border-b-2 border-[#ff4057] hover:border-red-700"
                      >
                        our Privacy Policy.</a
                      >
                    </span>
                  </label>
                </div>
               
                <ul>
                  <li class="flex items-center py-1">
                    <p class="text-sm text-red-900 py-1">Already a member?</p>
                    <a
                      href="./login.php"
                      class="underline text-sm text-red-900 transition duration-300 ease-in-out hover:text-red-700 px-1"
                      >Log in!</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="./main.js"></script>
  </body>
</html>
