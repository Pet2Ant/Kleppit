<?php
session_start();
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

<body class="bg-zinc-900 ">
    <!-- Loader -->
    <div id="loader" class="loader fixed top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-[#ff4057]"></div>
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
            <div class="mx-4 flex flex-1 items-center space-x-3 rounded border border-[#343536] bg-[#272729] px-4 py-1.5">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-[#878A8C]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <input class="flex-1 bg-transparent text-sm focus:outline-none text-gray-400" type="text" placeholder="Search Kleppit" />
            </div>
          </div>
          <!-- User button -->
          <div class="space-x-4 py-6 flex flex-col justify-center ">
            <div class="flex items-center justify-center">
              <div class="relative inline-block text-left dropdown">
                <span class="rounded-md shadow-sm">
                  <button class="flex items-center w-full text-sm font-medium leading-5 text-[#ff4057] transition duration-150 ease-in-out hover:text-red-600" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
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
                      <p class="text-sm leading-5 text-[#ff4057]">Signed in as</p>
                      <p class="text-md font-semibold leading-5 text-[#ff4957] truncate"><?php echo $_SESSION["email"]; ?></p>
                      <p class="text-sm leading-5 text-[#ff4957] truncate py-1">
                        1234 Upvotes
                      </p>
                    </div>
                    <div class="py-1">
                      <a href="./Profile.php" tabindex="0" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Profile</a>
                      <a href="./ContactUs.php" tabindex="1" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Contact Us</a>
                    </div>
                    <div class="py-1">
                      <a href="./userAgreement.html" tabindex="2" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">User Agreement</a>


                      <a href="./privacyPolicy.html" tabindex="2" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Privacy Policy</a>
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

    <div class="py-36 mt-12">
        <div class="flex flex-row justify-center">
            <div class="flex flex-row ">
                <!-- Post Body -->
                <div class="flex-1 border border-[#878A8C] bg-zinc-800 rounded-md max-w-lg max-h-lg mx-auto px-14 ">
                    <img src="../assets/kleppit-high-resolution-logo-color-on-transparent-background.png" alt="logo"
                        class="py-6 w-1/2 mx-auto"/>
                        <div class="w-full">
                            <div class="mt-6">
                                <div class="text-center font-semibold text-2xl text-[#ff4057]">
                                    What's on your mind?
                                </div>
                                <!-- 2 buttons to choose from, text and image-->
                                <div class="mt-6">
                                    <div class="flex justify-center">
                                        <div class="flex">
                                            <span class="inline-flex rounded-md shadow-sm">
                                                <button onclick="changeButton()" type="button" id="textButton"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-[#ff4057] hover:bg-[#ff4957] focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-[#ff4957] transition duration-300 ease-in-out">
                                                    Text
                                                </button>
                                            </span>
                                            <span class="ml-3 inline-flex rounded-md shadow-sm">
                                                <button onclick="changeButton()" type="button" id="imageButton"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-[#ff4057] bg-zinc-800 hover:text-[#ff4957] focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-[#ff4957] transition duration-300 ease-in-out hover:bg-[#ff4957] hover:text-white">
                                                    Image
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>






                                <form action="../post.php" method="post" class="mt-8">
                                    <div class="mx-auto max-w-lg">
                                        <div class="py-1">
                                            <span class="px-1 text-md text-[#ff4057]">Title</span>
                                            <input placeholder="Title..." type="text" name="title"
                                                class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-[#ff4957] focus:outline-none" />
                                        </div>
                                        <div class="py-1">
                                            <span class="px-1 text-md text-[#ff4057]">Content</span>
                                            <!-- Text Area -->
                                            <textarea id="textArea" name="content" placeholder="Share your thoughts" type="text"
                                                class="resize-y text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-[#ff4957] focus:outline-none"></textarea>
                                            <!-- Image Area -->
                                            <div class="flex items-center justify-center w-full hidden"
                                                id="imageUpload">
                                                <label for="dropzone-file"
                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-zinc-700 hover:bg-zinc-600">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                            </path>
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                                class="font-semibold">Click to upload</span> or drag and
                                                            drop</p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG,
                                                            JPG or GIF (MAX. 800x400px)</p>
                                                    </div>
                                                    <input id="dropzone-file" type="file" class="hidden" />
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="py-2">
                                        <button type="submit" name="submit"
                                            class="mt-3 w-full bg-[#ff4957] text-white active:bg-[#ff4957] text-sm font-semibold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition duration-150 ease-in-out hover:bg-red-700">
                                            Create Post
                                        </button>
                                    </div>
                                </form>

































                            </div>
                        </div>
                </div>
                <!-- Rules Sidebar -->
                <div class="flex-1 max-w-sm pl-9  hidden lg:block ">
                    <div class="py-2">
                        <div class="flex justify-center ">
                            <div class="w-80 pb-2 border bg-zinc-900 border-gray-500 rounded-lg ">
                                <div
                                    class="p-3 bg-[url('../assets/kleppit-high-resolution-logo-white-on-black-background-cropped.png')] bg-contain rounded-lg object-cover h-16">
                                    <div class="mt-12 pt-1">
                                        <hr class="w-full border-1 border-slate-700" />
                                    </div>
                                </div>

                                <div class="flex flex-col items-center px-2">

                                    <div class="underline text-center font-semibold text-xl text-[#ff4057]">
                                        Rules
                                    </div>
                                    <div class="underline underline-offset-4 mt-3 text-[#ff4057]">
                                        <div class="text-center font-semibold py-1 text-sm">
                                            1. No NSFW Content
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            2. No Spam
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            3. No Racism
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            4. No Illegal Activity
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            5. No Harassment
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            6. No Advertising
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            7. No Impersonation
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            8. No Trolling
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            9. No Self Promotion
                                        </div>
                                    </div>
                                </div>
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