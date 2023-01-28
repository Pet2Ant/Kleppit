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


//Check if url query has the username
if(isset($_GET["u"]))
{   
    //TODO fetch user info from database
    $userInfo = $postInfo->getUserByName($_GET["u"]);

    //Check if user exists
    if($userInfo == null)
    {
        //TODO redirect to 404 page
        echo "User does not exist";
        exit();
    }

    $user_id = $userInfo[0]["id"];
    $user_username = $userInfo[0]["username"];
    $user_email = $userInfo[0]["email"];
}
else
{
    $user_id = $_SESSION["id"];
    $user_username = $_SESSION["username"];
    $user_email = $_SESSION["email"];
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
Red text: text-red-500 hover:text-red-600
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
                                    <p class="hidden lg:block"><?php echo $user_username; ?></p>
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
                                    <p class="text-md font-semibold leading-5 text-red-600 truncate"><?php echo $user_email; ?></p>
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
    <div id="main" class=" py-12 mt-12 relative">
        <div id="container" class=" container mx-auto">
            <div class="py-2 mb-4 ">
                <div class="flex justify-start flex-row mb-3 ml-5">
                    <!-- Posts button to display all posts -->
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="button" id="textButton" onclick="javascript:window.location.href='./Profile.php?u=<?php echo $user_username?>'"class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-red-500 bg-zinc-800 hover:text-red-600 focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-red-600 transition duration-300 ease-in-out hover:bg-red-600 hover:text-white" >
                            Posts
                        </button>
                    </span>
                    <!-- Comments button to display all comments -->
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="button" id="imageButton" onclick="javascript:window.location.href='./ProfileComments.php?u=<?php echo $user_username?>'" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-red-600 transition duration-300 ease-in-out" >
                            Comments
                        </button>
                    </span>
                </div>


                <div class="flex w-960 mx-auto">
                    <!-- Comments -->
                    <div class="w-11/12 ml-5">
                    <div class="flex flex-col space-y-3">
                        <?php
                        $postInfo->fetchUserComment($user_id);
                        ?>
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
                                                echo $user_username;
                                            ?>
                                        </h1>
                                    </div>
                                    <div class="flex justify-center items-center py-1">
                                        <p class="text-sm text-gray-400"><?php $profileInfo->fetchTitle($user_id); ?></p>
                                    </div>
                                    <div class="flex justify-center items-center py-1">
                                        <p class="text-xs text-gray-400">Joined <?php $profileInfo->fetchDate($user_id); ?></p>
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

                                        <div class="mt-5 overflow-visible ">
                                            <div class="flex justify-center items-center ">
                                                <p class="overflow-visible text-sm text-gray-400 break-all">
                                                    <?php $profileInfo->fetchAbout($user_id); ?>
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
                                            <a href="./userAgreement.php" class="no-underline text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">User Agreement</a>
                                            |
                                            <a href="./privacyPolicy.php" class="no-underline text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">Privacy Policy</a>
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
</body>
<script src="./main.js"></script>


</html>