<?php
session_start();

include '../search/sharebar.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kleppit</title>
    <link rel="icon" href="../assets/kleppit-website-favicon-color.png" />
    <link rel="stylesheet" href="./css/style.css" />
  </head>
  <!-- COLORS: 
Background: bg-zinc-900
Red text: text-red-500 hover:text-red-600
Post content title: text-gray-400
Post content text: text-gray-500
-->
  <body id="page" class="scroll-smooth bg-zinc-900 md:scrollbar-default">
    <!-- Loader -->
    <div id="loader" class="loader fixed top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
      <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-red-500"></div>
   </div>
   <!-- Header Bar -->
  <header id="header" class="fixed inset-0 z-50 flex h-14 bg-[#1a1a1b] select-none">

    <div class="flex flex-1 items-center space-x-4 border-b border-[#343536] px-5">
      <!-- Icon + Post button + Search bar -->
      <div class="flex flex-1 items-center space-x-4">
        <!-- Large logo -->
        <a id="largeLogo" href="./index.php"><img src="..//assets/kleppit-high-resolution-logo-color-on-transparent-background.png" class="hidden lg:block h-10 transition duration-500 ease-in-out hover:opacity-75" alt="logo" />
        </a>
        <!-- Small Logo -->
        <a id="smallLogo" href="./index.php"><img src="..//assets/kleppit-website-favicon-color.png" class="lg:hidden h-12 w-14 transition duration-500 ease-in-out hover:opacity-75 mr-10" alt="small logo" />
        </a>
        <!-- Post button -->
        <button onclick="location.href = './createPost.php';" class="w-14 text-md font-bold bg-gray-300 transition duration-500 ease-in-out hover:bg-gray-400 rounded-full p-1 lg:hidden">
          Post
        </button>
        <!-- Search bar -->
        <?php
          $searchbar = new Searchbar();
          $searchbar->generateSearchbar();
        ?>
      </div>
      <!-- User button -->
      <div class="space-x-4 py-6 flex flex-col justify-center ">
        <div class="flex items-center justify-center">
          <div class="relative inline-block text-left dropdown">
            <span class="rounded-md shadow-sm">
              <button class="flex items-center w-full text-sm font-medium leading-5 text-red-500 transition duration-150 ease-in-out hover:text-red-600" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                <!-- if user is not logged in do not display the user photo -->
                <?php
                if (isset($_SESSION["id"])) {
                ?>
                  <img class="w-8 h-8 mr-2 rounded-full" src="../assets/tacejm6avjx41.jpg" alt="user photo" />
                <?php
                } else {
                ?>
                  <div class="hidden"></div>
                <?php
                }
                ?>
                <?php
                if (isset($_SESSION["id"])) {
                ?>
                  <p class="hidden lg:block"><?php echo $_SESSION["username"]; ?></p>
                  <svg class="w-4 h-4 mx-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
              </button>
            </span>

            <!-- User Dropdown menu -->
            <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
              <div class="absolute right-0 w-56 mt-2 origin-top-right bg-[#1a1a1b] border border-[#343536] divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                <div class="px-4 py-3">
                  <p class="text-sm leading-5 text-red-500">Signed in as</p>
                  <p class="text-md font-semibold leading-5 text-red-600 truncate"><?php echo $_SESSION["email"]; ?></p>
                  <p class="text-sm leading-5 text-red-600 truncate py-1">
                    1234 Upvotes
                  </p>
                </div>
                <div class="py-1">
                  <a href="./Profile.php" tabindex="0" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Profile</a>
                  <a href="./ContactUs.php" tabindex="1" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Contact Us</a>
                </div>
                <div class="py-1">
                  <a href="./userAgreement.php" tabindex="2" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">User Agreement</a>


                  <a href="./privacyPolicy.php" tabindex="2" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Privacy Policy</a>
                </div>
                <div class="py-1">
                  <a href="..\login\logout.php" tabindex="4" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Sign out</a>
                </div>
                <div>
                <?php
                } else {
                ?>
                  <a href="./signupform.php" tabindex="4" class="text-red-500 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-red-600" role="menuitem">Signup</a>

                  <a href="./loginform.php" tabindex="4" class="text-red-500 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-red-600" role="menuitem">Log in</a>
                <?php
                }
                ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
    
    <!-- Main content -->
    <div class="py-12 mt-12">
      <div class="container mx-auto">
        <!-- Section: Design Block -->
        <section class="mb-32 text-gray-500">
          <div
            class="relative overflow-hidden bg-no-repeat  bg-[url('../assets/kleppit-low-resolution-logo-white-on-transparent-background.png')] py-28" style="background-position: 50%;"
          ></div>
          <div class="container text-gray-800 px-4 md:px-12">
            <div
              class="block rounded-lg shadow-lg py-10 md:py-12 px-2 md:px-6 -mt-12 backdrop-blur-md	 bg-zinc-800 border rounded-md border-zinc-700"
            >
              <div class="flex flex-wrap">
                <div
                  class="grow-0 shrink-0 basis-auto w-full xl:w-5/12 px-3 lg:px-6 mb-12 xl:mb-0"
                >
                  <form>
                    <div class="form-group mb-6">
                        <input placeholder="Name" type="text"
                        class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-600 focus:outline-none"></input>
                    </div>
                    <div class="form-group mb-6">
                        <div class="form-group mb-6">
                            <input placeholder="Email Address" type="text"
                            class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-600 focus:outline-none"></input>
                        </div>
                    </div>
                    <div class="form-group mb-6">
                      <textarea rows="3" placeholder="Your message" type="text"
                      class="resize-y text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-600 focus:outline-none"></textarea>
                    </div>
                    <div class="form-group form-check text-center mb-6">
                      <input
                        type="checkbox"
                        class="form-check-input appearance-none h-4 w-4 border border-red-500 rounded-sm bg-red-500 checked:bg-red-700 checked:border-red-800 focus:outline-none transition duration-200 mt-1 align-top bg-center bg-contain mr-2 cursor-pointer"
                        id="exampleCheck87"
                       />
                      <label
                        class="form-check-label inline-block text-gray-500"
                        >Save this message to my account</label
                      >
                    </div>
                    <button type="submit"
                    class="mt-3 w-full bg-red-600 text-white active:bg-red-600 text-sm font-semibold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition duration-150 ease-in-out hover:bg-red-700">
                    Send
                </button>
                  </form>
                </div>
                <div class="grow-0 shrink-0 basis-auto w-full xl:w-7/12">
                  <div class="flex flex-wrap">
                    <div
                      class="mb-12 grow-0 shrink-0 basis-auto w-full md:w-6/12 px-3 lg:px-6"
                    >
                      <div class="flex items-start">
                        <div class="shrink-0">
                          <div
                            class="p-4 bg-red-500 rounded-md shadow-md w-14 h-14 flex items-center justify-center"
                          >
                            <svg
                              aria-hidden="true"
                              focusable="false"
                              data-prefix="fas"
                              data-icon="headset"
                              class="w-5 text-white"
                              role="img"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 512 512"
                            >
                              <path
                                fill="currentColor"
                                d="M192 208c0-17.67-14.33-32-32-32h-16c-35.35 0-64 28.65-64 64v48c0 35.35 28.65 64 64 64h16c17.67 0 32-14.33 32-32V208zm176 144c35.35 0 64-28.65 64-64v-48c0-35.35-28.65-64-64-64h-16c-17.67 0-32 14.33-32 32v112c0 17.67 14.33 32 32 32h16zM256 0C113.18 0 4.58 118.83 0 256v16c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16v-16c0-114.69 93.31-208 208-208s208 93.31 208 208h-.12c.08 2.43.12 165.72.12 165.72 0 23.35-18.93 42.28-42.28 42.28H320c0-26.51-21.49-48-48-48h-32c-26.51 0-48 21.49-48 48s21.49 48 48 48h181.72c49.86 0 90.28-40.42 90.28-90.28V256C507.42 118.83 398.82 0 256 0z"
                              ></path>
                            </svg>
                          </div>
                        </div>
                        <div class="grow ml-6">
                          <p class="font-bold mb-1 text-red-500">Technical support</p>
                          <p class="text-gray-500">support@example.com</p>
                          <p class="text-gray-500">+1 234-567-89</p>
                        </div>
                      </div>
                    </div>
                    <div
                      class="mb-12 grow-0 shrink-0 basis-auto w-full md:w-6/12 px-3 lg:px-6"
                    >
                      <div class="flex items-start">
                        <div class="shrink-0">
                          <div
                            class="p-4 bg-red-500 rounded-md shadow-md w-14 h-14 flex items-center justify-center"
                          >
                            <svg
                              aria-hidden="true"
                              focusable="false"
                              data-prefix="fas"
                              data-icon="dollar-sign"
                              class="w-3 text-white"
                              role="img"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 288 512"
                            >
                              <path
                                fill="currentColor"
                                d="M209.2 233.4l-108-31.6C88.7 198.2 80 186.5 80 173.5c0-16.3 13.2-29.5 29.5-29.5h66.3c12.2 0 24.2 3.7 34.2 10.5 6.1 4.1 14.3 3.1 19.5-2l34.8-34c7.1-6.9 6.1-18.4-1.8-24.5C238 74.8 207.4 64.1 176 64V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48h-2.5C45.8 64-5.4 118.7.5 183.6c4.2 46.1 39.4 83.6 83.8 96.6l102.5 30c12.5 3.7 21.2 15.3 21.2 28.3 0 16.3-13.2 29.5-29.5 29.5h-66.3C100 368 88 364.3 78 357.5c-6.1-4.1-14.3-3.1-19.5 2l-34.8 34c-7.1 6.9-6.1 18.4 1.8 24.5 24.5 19.2 55.1 29.9 86.5 30v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-48.2c46.6-.9 90.3-28.6 105.7-72.7 21.5-61.6-14.6-124.8-72.5-141.7z"
                              ></path>
                            </svg>
                          </div>
                        </div>
                        <div class="grow ml-6">
                          <p class="font-bold mb-1 text-red-500">Sales questions</p>
                          <p class="text-gray-500">sales@example.com</p>
                          <p class="text-gray-500">+1 234-567-89</p>
                        </div>
                      </div>
                    </div>
                    <div
                      class="mb-12 md:mb-0 grow-0 shrink-0 basis-auto w-full md:w-6/12 px-3 lg:px-6"
                    >
                      <div class="flex align-start">
                        <div class="shrink-0">
                          <div
                            class="p-4 bg-red-500 rounded-md shadow-md w-14 h-14 flex items-center justify-center"
                          >
                            <svg
                              aria-hidden="true"
                              focusable="false"
                              data-prefix="fas"
                              data-icon="newspaper"
                              class="w-5 text-white"
                              role="img"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 576 512"
                            >
                              <path
                                fill="currentColor"
                                d="M552 64H88c-13.255 0-24 10.745-24 24v8H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h472c26.51 0 48-21.49 48-48V88c0-13.255-10.745-24-24-24zM56 400a8 8 0 0 1-8-8V144h16v248a8 8 0 0 1-8 8zm236-16H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm-208-96H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm0-96H140c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h360c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12z"
                              ></path>
                            </svg>
                          </div>
                        </div>
                        <div class="grow ml-6">
                          <p class="font-bold mb-1 text-red-500">Press</p>
                          <p class="text-gray-500">press@example.com</p>
                          <p class="text-gray-500">+1 234-567-89</p>
                        </div>
                      </div>
                    </div>
                    <div
                      class="grow-0 shrink-0 basis-auto w-full md:w-6/12 px-3 lg:px-6"
                    >
                      <div class="flex align-start">
                        <div class="shrink-0">
                          <div
                            class="p-4 bg-red-500 rounded-md shadow-md w-14 h-14 flex items-center justify-center"
                          >
                            <svg
                              aria-hidden="true"
                              focusable="false"
                              data-prefix="fas"
                              data-icon="bug"
                              class="w-5 text-white"
                              role="img"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 512 512"
                            >
                              <path
                                fill="currentColor"
                                d="M511.988 288.9c-.478 17.43-15.217 31.1-32.653 31.1H424v16c0 21.864-4.882 42.584-13.6 61.145l60.228 60.228c12.496 12.497 12.496 32.758 0 45.255-12.498 12.497-32.759 12.496-45.256 0l-54.736-54.736C345.886 467.965 314.351 480 280 480V236c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v244c-34.351 0-65.886-12.035-90.636-32.108l-54.736 54.736c-12.498 12.497-32.759 12.496-45.256 0-12.496-12.497-12.496-32.758 0-45.255l60.228-60.228C92.882 378.584 88 357.864 88 336v-16H32.666C15.23 320 .491 306.33.013 288.9-.484 270.816 14.028 256 32 256h56v-58.745l-46.628-46.628c-12.496-12.497-12.496-32.758 0-45.255 12.498-12.497 32.758-12.497 45.256 0L141.255 160h229.489l54.627-54.627c12.498-12.497 32.758-12.497 45.256 0 12.496 12.497 12.496 32.758 0 45.255L424 197.255V256h56c17.972 0 32.484 14.816 31.988 32.9zM257 0c-61.856 0-112 50.144-112 112h224C369 50.144 318.856 0 257 0z"
                              ></path>
                            </svg>
                          </div>
                        </div>
                        <div class="grow ml-6">
                          <p class="font-bold mb-1 text-red-500">Bug report</p>
                          <p class="text-gray-500">bugs@example.com</p>
                          <p class="text-gray-500">+1 234-567-89</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Section: Design Block -->
      </div>
    </div>
  </body>
  <script src="./main.js"></script>
</html>
