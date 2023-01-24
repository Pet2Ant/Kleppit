

<?php
session_start();
include "../databasecon/dbcon.php";
include "../profile/profileinfo.php";
include "../profile/profilecontr.php";
include "../profile/profileview.php";
include "../post/postsql.php";
include "../post/postcont.php";
include "../post/postview.php";
$profileInfo = new ProfileInfoView();
$postInfo = new PostInfoView();



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

<body id="page" class="scroll-smooth bg-zinc-900 md:scrollbar-default ">
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

    <!-- Main content -->
    <div id="main" class=" py-12 mt-12 relative">
        <div id="container" class=" container mx-auto">
            <div class="py-2 mb-4 ">
                <div class="flex justify-start flex-row mb-3 ml-5">
                    <!-- Posts button to display all posts -->
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="button" id="textButton" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-[#ff4057] hover:bg-[#ff4957] focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-[#ff4957] transition duration-300 ease-in-out">
                            Posts
                        </button>
                    </span>
                    <!-- Comments button to display all comments -->
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="button" id="imageButton" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-[#ff4057] bg-zinc-800 hover:text-[#ff4957] focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-[#ff4957] transition duration-300 ease-in-out hover:bg-[#ff4957] hover:text-white">
                            Comments
                        </button>
                    </span>
                </div>


                <div class="flex w-960 mx-auto">
                    <!-- Posts -->
                    <div class="w-11/12 ml-5">
                        <!-- Post 1 -->
                        <div id="" class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <!-- Upvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <!-- Downvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                        <?php $postInfo->fetchTitle($_SESSION["id"]); ?>
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500">
                                        <?php $postInfo->fetchContent($_SESSION["id"]); ?>

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <!-- Share -->
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 2 -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <!-- Upvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <!-- Downvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Praesent euismod congue nibh, in placerat risus pretium at.

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <!-- Share -->
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 3 -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <!-- Upvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <!-- Downvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Praesent euismod congue nibh, in placerat risus pretium at.

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <!-- Share -->
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 4/ Large Image Post -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <div class="flex flex-col text-center py-2">
                                        <img src="../assets/licensed-image.jpg" alt="Post Image" class="rounded-lg mr-4" />
                                        <h3 class="text-gray-500 text-md py-2">
                                            Look at this image! WOW! SO COOL!
                                        </h3>
                                    </div>
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 5 -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <!-- Upvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <!-- Downvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Praesent euismod congue nibh, in placerat risus pretium at.

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <!-- Share -->
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 6 -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <!-- Upvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <!-- Downvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Praesent euismod congue nibh, in placerat risus pretium at.

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <!-- Share -->
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 7 -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <!-- Upvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <!-- Downvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Praesent euismod congue nibh, in placerat risus pretium at.

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <!-- Share -->
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 8/ Smaller Image Post -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <div class="flex flex-col text-center py-2">
                                        <img src="../assets/Screenshot_20221022_111506.png" alt="Post Image" class="rounded-lg mr-4" />
                                        <h3 class="text-gray-500 text-md py-2">
                                            Look at this image! WOW! SO COOL!
                                        </h3>
                                    </div>
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 9 -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <!-- Upvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <!-- Downvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Praesent euismod congue nibh, in placerat risus pretium at.

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <!-- Share -->
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post 10 -->
                        <div class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                    <!-- Upvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                                    <!-- Downvote -->
                                    <button class="text-xs">
                                        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2">
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/TestUser</a>
                                        <span class="text-gray-500">2 hours ago</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse tempor placerat turpis eu semper.
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Praesent euismod congue nibh, in placerat risus pretium at.

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                        </div>
                                        <!-- Share -->
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  Sidebars -->
                    <div class="w-1/3 pl-9 hidden lg:block">
                        <div class="py-2">
                            <div class="flex justify-center items-center bg-zinc-900">
                                <div class="w-80 pb-2 border border-gray-500 rounded-lg overflow-hidden">
                                    <div class="p-3 bg-[url('../assets/kleppit-high-resolution-logo-white-on-black-background-cropped.png')] bg-contain object-cover h-16"></div>
                                    <div class="flex justify-center avatar">
                                        <div class="w-48 ">
                                            <img class="border-2 my-5 border-red-500 rounded-full" src="https://placeimg.com/192/192/people" />
                                        </div>
                                    </div>

                                    <!-- get username from session and output it -->
                                    <div class="flex justify-center items-center">
                                        <h1 class="text-2xl font-bold text-gray-300">
                                            <?php
                                            echo $_SESSION['username'];
                                            ?>
                                        </h1>
                                    </div>
                                    <div class="flex justify-center items-center py-1">
                                        <p class="text-sm text-gray-400">Kleppit Member</p>
                                    </div>
                                    <div class="flex justify-center items-center py-1">
                                        <p class="text-xs text-gray-400">Joined 01/01/2021</p>
                                    </div>
                                    <!-- Profile Button -->
                                    <div class="flex justify-center items-center py-1">
                                        <button onclick="location.href = './editProfile.php';" class="w-40 text-sm font-bold bg-gray-300 transition duration-500 ease-in-out hover:bg-gray-400 rounded-full p-1">
                                           Edit Profile
                                        </button>
                                    </div>

                                    <div class="px-2">
                                        <div class="mt-5">
                                            <hr class="border-1 border-slate-700" />
                                        </div>
                                        <div class="mt-2">
                                            <p class="text-sm font-semibold text-gray-400">
                                                <?php $profileInfo->fetchIntroduction($_SESSION["id"]); ?>
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
        <!-- Scroll to the top button -->
        <div class="fixed bottom-0 right-0 mb-10 mr-10">
            <div class="flex flex-col gap-2">
                <button onclick="topFunction()" class="w-full w-12 h-12 bg-[#ff4057] rounded-full hover:bg-red-600 transition ease-in duration-300 flex justify-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 place-self-center">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5" />
                    </svg>

                </button>
            </div>
        </div>
</body>
<script src="./main.js"></script>

</html>
Footer
© 2023 GitHub, Inc.
Footer navigation
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
