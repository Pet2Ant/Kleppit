<?php
session_start();

$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$postId = $_SERVER["QUERY_STRING"];
parse_str($postId, $postId);
if (!$postId) {
    echo "page doesnt exist";
    exit();
}
$postId = $postId["p"] +1;



include "../databasecon/dbcon.php";
include "../post/postsql.php";
include "../post/postcont.php";
include "../post/pageview.php";

$post= new PageInfo();
$postInfo =  $post->getPostInfo($postId);
if(empty($postInfo))
{
    echo "asdADF??";
    exit();
}
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
            <div class="flex w-960 mx-auto">
                <!-- Container -->
                <div class="w-11/12 ml-5 bg-[#272729] border border-[#343536] bg-[#272729] rounded">
                    <!-- Post -->
                    <div class="py-2 mb-4">
                        <div class="flex rounded">
                            <div class="w-5 mx-4 flex flex-col text-center pt-2">
                                <!-- Upvote -->
                                <button class="text-xs">
                                    <input type="text" hidden disabled>
                                    <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                    </svg>
                                </button>
                                <!-- Vote count -->
                                <span class="text-xs font-semibold my-1 text-gray-500"><?php echo $postInfo["post_karma"];?></span>
                                <!-- Downvote -->
                                <button class="text-xs">
                                    <input type="text" hidden disabled>
                                    <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Post Information -->
                            <div class="w-11/12 pt-2 ">
                                <div class="flex items-center text-xs mb-2">
                                    <span class="text-gray-500">Posted by <?php echo $postInfo["username"];?></span>
                                    <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/<?php

                                    ?></a>
                                    <span class="text-gray-500">2 hours ago</span>
                                </div>
                                <!-- Post Title -->
                                <div>
                                    <h2 class="text-lg font-bold mb-1 text-gray-300">
                                       <?php echo $postInfo["post_title"]; ?>
                                    </h2>
                                </div>
                                <!-- Post Description -->
                                <p class="text-gray-400">
                                <?php echo $postInfo["post_content"]; ?>

                                </p>

                                <!-- Post Actions -->
                                <div class="inline-flex items-center my-1 ">
                                    <div class="flex p-1 rounded-lg">
                                        <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                        </svg>
                                        <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                                    </div>
                                </div>
                                <hr class="border-b-1 border-zinc-700 mx-auto">
                            </div>

                        </div>
                        
                        <div class="relative w-11/12 mx-auto py-10 min-w-[200px] border-b-1 border-zinc-700 border-dashed ">
                            <div class="pb-1">
                                <label for="textArea" class="text-sm text-gray-500 ">
                                    Comment as <a class="no-underline hover:underline" href="./Profile.php">u/<?php

                                    ?></label></a>
                            </div>

                            <textarea id="textArea" name="content" placeholder="Share your thoughts" type="text" class="resize-y text-sm block  px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-[#ff4957] focus:outline-none"></textarea>
                            <div class="flex justify-end">
                                <button type="submit" name="submit" class="mt-3 w-32 bg-[#ff4957] text-white active:bg-[#ff4957] text-sm font-semibold uppercase px-2 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none  ease-linear transition duration-150 ease-in-out hover:bg-red-700">
                                    Comment
                                </button>
                            </div>
                        </div>
                        <!-- Sort by dropdown -->
                        <div class="flex items-center mx-auto p-4">
                            <label class="text-xs text-red-500 mr-2">Sort by</label>
                            <div class="relative w-32 ">
                                <select class="text-red-500 block appearance-none w-full bg-zinc-800 border-2 border-zinc-700 text-gray-500 py-2 px-3 pr-8 rounded-lg shadow leading-tight focus:outline-none focus:bg-zinc-900 focus:border-zinc-600" id="grid-state">
                                    <option>New</option>
                                    <option>Old</option>
                                    <option>Top</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M7 7l3-3 3 3v8H7V7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <hr class="border-t-1 border-zinc-700">
                    </div>

                    <div class="flex justify-center mb-5 mx-5">
                        <div class="flex border border-[#343536] bg-[#272729] rounded p-3">
                            <!-- Comment Body -->
                            <div class="w-11/12 pt-2">
                                <!-- Comment Information -->
                                <div class="flex items-center text-sm mb-2">
                                    <img class="w-8 h-8 rounded-full mr-2" src="https://placeimg.com/192/192/people" alt="Avatar of User">
                                    <span class="text-gray-500">Commented by</span>
                                    <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">u/<?php ?> •</a>
                                    <span class="text-gray-500">2 hours ago</span>
                                </div>
                                <!-- Comment Text -->
                                <p class="text-gray-400 text-md">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Praesent euismod congue nibh, in placerat risus pretium at.
                                </p>
                                <!-- Comment Actions -->
                                <div class="w-5 mx-4 flex flex-row text-center pt-2 space-x-4">
                                    <!-- Upvote -->
                                    <button class="text-gray-500 transition duration-500 hover:text-red-500 duration-500 hover:bg-gray-700 p-0.5 rounded-lg flex flex-row">
                                        <input type="text" hidden disabled>
                                        <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                        </svg>
                                        <span class="ml-2 text-xs font-semibold text-gray-500 py-0.5 "></span>
                                    </button>
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 m-2 text-gray-400"></span>
                                    <!-- Downvote -->
                                    <button class="text-gray-500 transition duration-500 hover:text-blue-500 duration-500 hover:bg-gray-700 p-0.5 rounded-lg flex flex-row">
                                        <input type="text" hidden disabled>
                                        <svg class="w-5 fill-current " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                                        </svg>
                                        <span class="ml-2 text-xs font-semibold text-gray-500 py-0.5 "></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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