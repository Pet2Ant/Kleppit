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
include '../components/navbar.php';

$postInfo = new IndexPostInfo();
$survey =  new PostInfo();

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
Red text: text-red-500 hover:text-[#ff4957]
Post content title: text-gray-400
Post content text: text-gray-500
-->

<body id="page" class="scroll-smooth bg-zinc-900 md:scrollbar-default h-screen">
  <!-- Loader -->
  <div id="loader" class="loader fixed top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
    <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-red-500"></div>
  </div>

  <!-- Nav Bar -->

  <?php
    $navbar = new Navbar();
    $navbar->genereElement();
  ?>
      
  <!-- Main content -->
  <div id="main" class=" py-12 mt-12 relative h-screen">

  <?php if($_SESSION)
              {
    
                if($survey->hasTakenSurvey($_SESSION["id"] ))
                 {
                ?>
        <div id="survey-popup" class="hidden backdrop-blur-sm rounded-lg mx-auto inset-0 z-50 absolute overflow-hidden">
      <div class="relative p-4 w-full max-w-lg h-full">
        <div class="border border-gray-500  px-10 py-10 bg-zinc-800 shadow-md rounded-3xl sm:p-10">
          <!-- close button -->
          
          <button onclick="closeSurvey()" class=" hover:text-red-500" >input
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
            </svg>
          </button>
          <div class="mx-auto">
            <!-- Headline -->
            
            <div class="flex flex-col font-sans space-y-6 sm:leading-7 text-center antialiased">
              <h1 id="title" class="text-3xl font-semibold text-red-500">Kleppit User Survey</h1>
              <h4 class="text-md font-medium text-red-500">Please invest a few moments of your time in answering this survey. Thank you!</h4>
            </div>

            <!-- Form -->
            <!-- Make sure user takes survey once  -->
            
            <form id="survey-form" action="../survey.php" method="post">
              <div class="grid grid-cols-6 gap-6 pt-8">
                <div class="col-span-6 sm:col-span-3">

                  <label for="first_name" class="block text-sm font-medium text-red-500">
                    First name
                  </label>
                  <div class="mt-1 flex rounded-md">


                    <input placeholder="Name" name="fname" type="text" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-500 focus:outline-none"></input>
                  </div>

                </div>

                <div class="col-span-6 sm:col-span-3">

                  <label id="name-label" for="name" class="block text-sm font-medium text-red-500">
                    Last name
                  </label>
                  <div class="mt-1 flex rounded-md">


                    <input placeholder="Your last name" name="lname" type="text" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-sm text-red-500 bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:border-zinc-600 focus:outline-none"></input>
                  </div>

                </div>

                <div class="col-span-6 sm:col-span-3">

                  <label for="name" class="block text-sm font-medium text-red-500">
                    Current role
                  </label>
                  <div class="mt-1 rounded-md">
                    <div class="relative">

                      <select id="dropdown" type="text" name="job" class="form-select block w-full h-10 px-4 mb-2 text-sm rounded-lg bg-zinc-800 text-red-500 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:border-zinc-600 focus:outline-none" placeholder="Employment">
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

                  <label id="number-label" for="name" class="block text-sm font-medium text-red-500">
                    Age
                  </label>
                  <div class="mt-1 flex rounded-md">

                    <input id="number" name="age" type="number" min="1" max="99" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-500 focus:outline-none" placeholder="Your age">
                  </div>

                </div>

                <div class="col-span-6 sm:col-span-6">
                  <label id="email-label" for="email" class="block text-sm font-medium text-red-500">
                    Email address
                  </label>
                  <div class="mt-1 flex rounded-md">

                    <input id="email" type="email" name="email" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-500 focus:outline-none" placeholder="Your email address" required="">
                  </div>
                </div>

                <div class="col-span-6 sm:col-span-6 mt-2 text-red-500">
                  <fieldset>
                    <legend class="text-base font-medium ">Would you recommend Kleppit to a friend?
                    </legend>
                    <div class="mt-4 space-y-4">

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="user_answer" type="radio" value="definitely" class="h-4 w-4 accent-red-500 focus:accent-red-600 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Definitely</label>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="user_answer" type="radio" value="maybe" class="h-4 w-4 accent-red-500 focus:accent-red-600 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Maybe</label>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="user_answer" type="radio" value="not_sure" class="h-4 w-4 accent-red-500 focus:accent-red-600 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Not sure</label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>

                <div class="col-span-6 sm:col-span-6 mt-2 text-red-500">
                  <fieldset>
                    <legend class="text-base font-medium ">What would you like to see improved?</legend>
                    <p class="text-sm text-gray-500">Check all that apply</p>
                    <div class="mt-4 space-y-4">


                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="comments" type="checkbox" value="FE" class="appearance-none h-4 w-4 border border-red-500 rounded-sm bg-red-500 checked:bg-red-700 checked:border-red-800 focus:outline-none transition duration-200 mt-1 align-top bg-center bg-contain mr-2 cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Overall feel</label>
                          <p class="text-gray-500">The overall feel of the site</p>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="comments" type="checkbox" value="FE" class="appearance-none h-4 w-4 border border-red-500 rounded-sm bg-red-500 checked:bg-red-700 checked:border-red-800 focus:outline-none transition duration-200 mt-1 align-top bg-center bg-contain mr-2 cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Front-end</label>
                          <p class="text-gray-500">Things like HTML, CSS or JS</p>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="comments" type="checkbox" value="BE" class="appearance-none h-4 w-4 border border-red-500 rounded-sm bg-red-500 checked:bg-red-700 checked:border-red-800 focus:outline-none transition duration-200 mt-1 align-top bg-center bg-contain mr-2 cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="comments" class="font-medium ">Back-end</label>
                          <p class="text-gray-500">Database improvements, PHP, NodeJS</p>
                        </div>
                      </div>

                      <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="comments" name="comments" type="checkbox" value="FS" class="appearance-none h-4 w-4 border border-red-500 rounded-sm bg-red-500 checked:bg-red-700 checked:border-red-800 focus:outline-none transition duration-200 mt-1 align-top bg-center bg-contain mr-2 cursor-pointer">
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
                  <label id="textarea" for="textfield" class="block text-sm font-medium text-red-500">
                    Any other feedback?
                  </label>
                  <div class="mt-1 flex rounded-md">

                    <textarea id="textArea" name="feedback" placeholder="Share your thoughts" type="text" class=class="resize-y text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-500 focus:outline-none"></textarea>
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
    <?php 
            }
            
            } ?>
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
            }else
            {
              $sortTo = "Controversial";
            }


            ?>
            <div class="mt-3">
              <span class="text-xl lg:inline-block hidden font-semibold text-gray-500 p-2">All posts</span>
              <span class="text-md md:inline-block hidden text-gray-500 tracking-tight">Sorted by:</span>

              <span class="ml-0.5 text-lg text-red-500 "><?php echo $sortTo?></span>

            </div>
            <div class="mt-3">
              <span class="md:inline-block hidden text-md text-gray-500">Sort by:</span>
              <button onclick="javascript:window.location.href='index.php?sort=karma'" class="px-4 py-2 font-medium text-red-500 border border-red-500 rounded-l-md hover:bg-red-500 hover:text-black transition duration-500 ease-in-out">
                Top
              </button>
              <button onclick="javascript:window.location.href='index.php?sort=controversial'"  class="px-4 py-2 font-medium text-red-500 border border-red-500 hover:bg-red-500 hover:text-black transition duration-500 ease-in-out">
                Sus
              </button>
              <button onclick="javascript:window.location.href='index.php?sort=newest'"  class="px-4 py-2 font-medium text-red-500 border border-red-500 hover:bg-red-500 hover:text-black transition duration-500 ease-in-out">
                New
              </button>
              <button onclick="javascript:window.location.href='index.php?sort=oldest'" class="px-4 py-2 font-medium text-red-500 border border-red-500 rounded-r-md hover:bg-red-500 hover:text-black transition duration-500 ease-in-out">
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
          }else
          {
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
                <p class="text-xs leading-tight font-medium text-red-500 my-1">
                  © 2023 Kleppit, Inc. All rights reserved
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Scroll to the top button -->
    <div class="fixed bottom-0 right-0 mb-10 mr-10">
        <div class="flex flex-col gap-2">
            <button onclick="topFunction()" class="w-full w-12 h-12 bg-red-500 rounded-full hover:bg-red-600 transition ease-in duration-300 flex justify-center ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 place-self-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5" />
                </svg>

            </button>
        </div>
    </div>
  </div>
</body>
<script src="./main.js"></script>

</html>