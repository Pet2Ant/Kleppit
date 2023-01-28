<?php
session_start();
include "../databasecon/dbcon.php";
include "../profile/profileinfo.php";
include "../profile/profilecontr.php";
include "../profile/profileview.php";
include "../post/postsql.php";
include "../post/postcont.php";
include "../post/postview.php";
include "../post/indexpost.php";

$postInfo = new IndexPostInfo();
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
  <link rel="stylesheet" href="./css/style.css">
</head>
<!-- COLORS: 
Background: bg-zinc-900
Red text: text-[#ff4057] hover:text-[#ff4957]
Post content title: text-gray-400
Post content text: text-gray-500
-->

<body id="page" class="scroll-smooth bg-zinc-900 md:scrollbar-default h-screen">
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
        <a id="largeLogo" href="./index.php"><img src="..//assets/kleppit-high-resolution-logo-color-on-transparent-background.png" class="hidden lg:inline-block h-10 transition duration-500 ease-in-out hover:opacity-75" alt="logo" />
        </a>
        <!-- Small Logo -->
        <a id="smallLogo" href="./index.php"><img src="..//assets/kleppit-website-favicon-color.png" class="lg:hidden h-12 w-14 transition duration-500 ease-in-out hover:opacity-75 mr-10" alt="small logo" />
        </a>

        <!-- Search bar -->
        <div class="mx-4 flex flex-1 items-center space-x-3 rounded border border-[#343536] bg-[#272729] px-4 py-1.5">
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-[#878A8C]">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </button>

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

  <!-- Main content -->
  <div id="main" class=" py-12 mt-12 relative h-screen">
    <div id="survey-popup" class="hidden overflow-auto backdrop-blur-sm rounded-lg mx-auto inset-0 z-50 absolute ">
      <div class="relative p-4 w-full max-w-lg h-full">
        <div class="border border-gray-500  px-10 py-10 bg-zinc-800 shadow-md rounded-3xl sm:p-10">
          <!-- close button -->
          <button onclick="closeSurvey()" class=" hover:text-[#ff4057]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
            </svg>
          </button>

          <div class="mx-auto">
            <!-- Headline -->
            <div class="flex flex-col font-sans space-y-6 sm:leading-7 text-center antialiased">
              <h1 id="title" class="text-3xl font-semibold text-[#ff4057]">Kleppit User Survey</h1>
              <h4 class="text-md font-medium text-[#ff4057]">Please invest a few moments of your time in answering this survey. Thank you!</h4>
            </div>

            <!-- Form -->
            <form id="survey-form" action="#">
              <div class="grid grid-cols-6 gap-6 pt-8">
                <div class="col-span-6 sm:col-span-3">

                  <label for="first_name" class="block text-sm font-medium text-[#ff4057]">
                    First name
                  </label>
                  <div class="mt-1 flex rounded-md">
                    <input placeholder="Name" type="text" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-gray-500 focus:outline-none"></input>
                  </div>

                </div>

                <div class="col-span-6 sm:col-span-3">

                  <label id="name-label" for="name" class="block text-sm font-medium text-[#ff4057]">
                    Last name
                  </label>
                  <div class="mt-1 flex rounded-md">
                    <input placeholder="Your last name" type="text" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-sm text-gray-500 bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:border-zinc-600 text-[#ff4957] focus:outline-none"></input>
                  </div>

                </div>

                <div class="col-span-6 sm:col-span-3">

                  <label for="name" class="block text-sm font-medium text-[#ff4057]">
                    Current role
                  </label>
                  <div class="mt-1 rounded-md">
                    <div class="relative">
                      <select id="dropdown" type="text" name="name" class="form-select block w-full h-10 px-4 mb-2 text-sm rounded-lg bg-zinc-800 text-gray-500
                        border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:border-zinc-600
                        focus:outline-none" placeholder="Employment">
                        <option>Employment Status</option>
                        <option>Student</option>
                        <option>Full-time job</option>
                        <option>Full-time learner</option>
                        <option>Prefer not to say</option>
                        <option>Other</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="col-span-6 sm:col-span-3">

                  <label id="number-label" for="name" class="block text-sm font-medium text-[#ff4057]">
                    Age
                  </label>
                  <div class="mt-1 flex rounded-md">
                    <input id="number" type="number" min="1" max="99" name="name" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-gray-500 focus:outline-none" placeholder="Your age">
                  </div>

                </div>

                <div class="col-span-6 sm:col-span-6">
                  <label id="email-label" for="email" class="block text-sm font-medium text-[#ff4057]">
                    Email address
                  </label>
                  <div class="mt-1 flex rounded-md">
                    <input id="email" type="email" name="name" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-gray-500 focus:outline-none" placeholder="Your email address" required="">
                  </div>
                </div>

                <div class="col-span-6 sm:col-span-6 mt-2 text-[#ff4057]">
                  <fieldset>
                    <legend class="text-base font-medium ">Would you recommend Kleppit to a friend?
                    </legend>
                    <div class="mt-4 space-y-4">

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="user_answer" type="radio" value="definitely" class="form-radio h-4 w-4 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Definitely</label>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="user_answer" type="radio" value="maybe" class="form-radio h-4 w-4 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Maybe</label>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="user_answer" type="radio" value="not_sure" class="form-radio h-4 w-4 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Not sure</label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>

                <div class="col-span-6 sm:col-span-6 mt-2 text-[#ff4057]">
                  <fieldset>
                    <legend class="text-base font-medium ">What would you like to see improved?</legend>
                    <p class="text-sm text-gray-500">Check all that apply</p>
                    <div class="mt-4 space-y-4">


                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="comments" type="checkbox" value="FE" class="h-4 w-4 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Overall feel</label>
                          <p class="text-gray-500">The overall feel of the site</p>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="comments" type="checkbox" value="FE" class="h-4 w-4 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Front-end</label>
                          <p class="text-gray-500">Things like HTML, CSS or JS</p>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="comments" type="checkbox" value="BE" class="h-4 w-4 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Back-end</label>
                          <p class="text-gray-500">Database improvements, PHP, NodeJS</p>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="comments" type="checkbox" value="FS" class="h-4 w-4 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Full-stack</label>
                          <p class="text-gray-500">The complete Stack for an End-to-End understanding</p>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>

                <div class="col-span-6 sm:col-span-6 mt-2 ">
                  <label id="textarea" for="textfield" class="block text-sm font-medium text-[#ff4057]">
                    Any other feedback?
                  </label>
                  <div class="mt-1 flex rounded-md">
                    <textarea id="textArea" placeholder="Share your thoughts" type="text" class="resize-y text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-gray-500 focus:outline-none"></textarea>
                  </div>
                </div>

                <div class="col-span-6 sm:col-span-2 mt-2">
                  <button type="submit" id="submit" class="inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-500 ease-in-out">
                    Submit
                  </button>
                </div>

              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
    <div id="container" class=" container mx-auto">
      <div class="flex w-960 mx-auto">
        <!-- Posts -->
        <div class="w-11/12 ml-5">
          <!-- Create Post button when md screen -->
          <div class="-mt-5">
            <button onclick="location.href = './createPost.php';" class="md:inline-block lg:hidden w-full text-md font-bold bg-gray-300 transition duration-500 ease-in-out hover:bg-gray-400 rounded-full p-1">
              Create Post
            </button>
          </div>
          <!-- Sort by top, new, old bar -->

          <div class="flex justify-between">


            <?php
            $sortquery = $_SERVER["QUERY_STRING"];
            parse_str($sortquery, $sortquery);
            $sortTo = "Default";
            if (!$sortquery) {
            } elseif ($sortquery["sort"] == "karma") {
              $sortTo = "by Karma";
            } elseif ($sortquery["sort"] == "newest") {
              $sortTo = "Newest";
            } elseif ($sortquery["sort"] == "oldest") {
              $sortTo = "Oldest";
            }


            ?>
            <div class="mt-3">
              <span class="text-xl lg:inline-block hidden font-semibold text-gray-500 p-2">All posts</span>
              <span class="text-md md:inline-block hidden text-gray-500 tracking-tight">Sorted by:</span>
              <span class="ml-0.5 text-lg text-red-500 ">Newest</span>
            </div>
            <div class="mt-3">
              <span class="md:inline-block hidden text-md text-gray-500">Sort by:</span>
              <button class="px-4 py-2 font-medium text-[#ff4057] border border-[#ff4057] rounded-l-md hover:bg-[#ff4057] hover:text-black transition duration-500 ease-in-out">
                Top
              </button>
              <button class="px-4 py-2 font-medium text-[#ff4057] border border-[#ff4057] hover:bg-[#ff4057] hover:text-black transition duration-500 ease-in-out">
                New
              </button>
              <button class="px-4 py-2 font-medium text-[#ff4057] border border-[#ff4057] rounded-r-md hover:bg-[#ff4057] hover:text-black transition duration-500 ease-in-out">
                Old
              </button>
            </div>
          </div>
          <?php

          $userId = -1;
          if ($_SESSION) {
            $userId = $_SESSION["id"];
          }
          if ($sortTo == "Default") {
            $postInfo->getAllPosts($sortTo, $userId);
          } elseif ($sortTo == "by Karma") {

            $postInfo->getAllPosts($sortTo, $userId);
          } elseif ($sortTo == "Newest") {

            $postInfo->getAllPosts($sortTo, $userId);
          } elseif ($sortTo == "Oldest") {

            $postInfo->getAllPosts($sortTo, $userId);
          }


          ?>

        </div>
        <!--  Sidebars -->
        <div class="w-1/3 pl-9 hidden lg:block">
          <!-- Create a Post Sidebar -->
          <div class="py-2">
            <div class="flex justify-center items-center bg-zinc-900">
              <div class="w-80 pb-2 border border-gray-500 rounded-lg overflow-hidden">
                <div class="p-3 bg-[url('../assets/kleppit-high-resolution-logo-white-on-black-background-cropped.png')] bg-contain object-cover h-16"></div>
                <div class="flex gap-2 items-center overflow-hidden px-2">
                  <div class="overflow-hidden rounded-full">
                    <img src="../assets/kleppit-website-favicon-color.png" class="w-14 h-14" alt="Kleppit Avatar" />
                  </div>
                  <div>
                    <span class="text-md font-semibold text-gray-400">Kleppit</span>
                  </div>
                </div>
                <div class="px-2">
                  <div class="mt-2">
                    <p class="text-sm font-semibold text-gray-400">
                      Your Personal Kleppit Frontpage. Come here to check in
                      on your favorite posts.
                    </p>
                  </div>
                  <div class="mt-5">
                    <hr class="border-1 border-slate-700" />
                  </div>
                  <div class="mt-5 flex flex-col gap-2">
                    <button onclick="location.href = './createPost.php';" class="w-full text-md font-bold bg-gray-300 transition duration-500 ease-in-out hover:bg-gray-400 rounded-full p-1">
                      Create Post
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Kleppit Guard Sidebar -->
          <div class="rounded bg-zinc-900 border border-gray-500 my-10 mb-4">
            <div class="p-2">
              <div class="flex items-center">
                <svg class="h-6 w-6 mr-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <title>Kleppit Guard</title>
                  <path d="M13.535 15.785c-1.678.244-2.883.742-3.535 1.071v-5.113a2 2 0 0 0-2-2H4.217c.044-.487.076-1.016.076-1.629 0-1.692-.489-2.968-.884-3.722L4.8 3.001H10v4.742a2 2 0 0 0 2 2h3.783c.06.67.144 1.248.22 1.742.097.632.182 1.177.182 1.745 0 1.045-.829 2.291-2.65 2.555m5.028-12.249l-2.242-2.242a1 1 0 0 0-.707-.293H4.386a1 1 0 0 0-.707.293L1.436 3.536a1 1 0 0 0-.069 1.337c.009.011.926 1.2.926 3.241 0 1.304-.145 2.24-.273 3.065-.106.684-.206 1.33-.206 2.051 0 1.939 1.499 4.119 4.364 4.534 2.086.304 3.254 1.062 3.261 1.065a1.016 1.016 0 0 0 1.117.004c.011-.007 1.18-.765 3.266-1.069 2.864-.415 4.363-2.595 4.363-4.534 0-.721-.099-1.367-.206-2.051-.128-.825-.272-1.761-.272-3.065 0-2.033.893-3.199.926-3.241a.999.999 0 0 0-.07-1.337"></path>
                </svg>
                <div class="flex flex-col">
                  <span class="text-xs font-semibold text-gray-400 mb-1">Non-Profit Kleppit</span>
                  <span class="text-xxs font-semibold text-gray-400">No ads, for your browsing pleasure!</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Kleppit Information Sidebar -->
          <div class="rounded border border-gray-500 my-10 mb-4">
            <div class="p-3">
              <div class="flex justify-between">
                <div>
                  <a href="./About.php" class="block no-underline text-xs font-semibold text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">About</a>
                </div>
                <div>
                  <a href="./ContactUs.php" class="block no-underline text-xs font-semibold text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">Contact Us</a>
                </div>
                <div>
                  <a href="./nonprofit.php" class="block no-underline text-xs font-semibold text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">Non-Profit
                  </a>
                </div>
              </div>
              <div class="text-center mt-6">
                <p class="text-xs leading-tight text-gray-400 font-medium">
                  <a href="./userAgreement.html" class="no-underline text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">User Agreement</a>
                  |
                  <a href="./PrivacyPolicy.html" class="no-underline text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">Privacy Policy</a>
                </p>
                <p class="text-xs leading-tight font-medium text-[#ff4057] my-1">
                  © 2023 Kleppit, Inc. All rights reserved
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="./main.js"></script>

</html>