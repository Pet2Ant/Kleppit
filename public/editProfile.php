<?php session_start();
include "../databasecon/dbcon.php";
include "../profile/profileinfo.php";
include "../profile/profilecontr.php";
include "../profile/profileview.php";
$profileInfo = new ProfileInfoView();

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

<body id="page" class="scroll-smooth bg-zinc-900 md:scrollbar-default ">
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
    <div id="main" class=" py-12 mt-12 relative">

        <div id="container" class=" container mx-auto">
            <h2 class="block uppercase text-3xl font-bold text-red-500">Profile</h2>
            <hr class="mt-6 border-t border-gray-400 pt-4 w-full">
            <div class="pt-2">
                <div class="container mx-auto">
                    <div class="inputs w-full max-w-2xl p-6 mx-auto">
                        <h2 class="text-2xl font-bold text-red-500">Account Security</h2>
                        <form action="../profile.php" method="post" class="mt-6 border-t border-gray-400 pt-4">
                            <div class='flex flex-wrap -mx-3 mb-6'>
                                <div class='w-full md:w-full px-3 mb-6'>
                                    <label class='block uppercase tracking-wide text-red-500 text-xs font-bold mb-2'>email address</label>
                                    <input placeholder="Update Email..." name="email" type="email" class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-red-600 focus:outline-none" />
                                </div>
                                <div class="w-full flex flex-row mx-auto">
                                    <div class=' md:w-1/2 px-3 mb-6'>
                                        <label class="block uppercase tracking-wide text-red-500 text-xs font-bold mb-2">Current Password</label>
                                        <input placeholder="Current Password..." type="password" name="password" class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-red-600 focus:outline-none" />

                                    </div>
                                    <div class='w-full md:w-1/2 px-3 mb-6'>
                                        <label class="block uppercase tracking-wide text-red-500 text-xs font-bold mb-2">New Password</label>
                                        <input placeholder="New Password..." type="password" name="newPassword" class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-red-600 focus:outline-none" />
                                    </div>
                                </div>


                                <div class="personal w-full pt-4">
                                    <h2 class="text-2xl font-bold text-red-500">Personal Info</h2>
                                    <hr class="mt-6 border-t border-gray-400 pt-4 w-full">
                                    <div class="flex items-center justify-between mt-4">

                                    </div>
                                    <!-- Change Avatar -->
                                    <label class='block uppercase tracking-wide text-red-500 text-xs font-bold mb-2'>Change avatar</label>
                                    <div class="flex justify-center avatar">
                                        <div class="w-48 ">
                                            <img class="hover:opacity-75 transition duration-500 ease-in-out cursor-pointer border-2 my-5 border-red-500 rounded-full" src="https://placeimg.com/192/192/people" />
                                        </div>
                                    </div>

                                    <div class='w-full md:w-full px-3 mb-6'>
                                        <label class="block uppercase tracking-wide text-red-500 text-xs font-bold mb-2">Username</label>
                                        <textarea placeholder="Display name" type="text" name="name" class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-red-600 focus:outline-none "><?php $profileInfo->fetchAbout($_SESSION['id']);?></textarea>
                                    </div>
                                    <div class='w-full md:w-full px-3 mb-6'>
                                        <label class='block uppercase tracking-wide text-red-500 text-xs font-bold mb-2'>Description</label>
                                        <textarea id="textArea" placeholder="Write something about yourself!" type="text" name="description" class="resize-y text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-600 focus:outline-none"><?php echo $profileInfo->fetchAbout($_SESSION['id']);?></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" name="submit" class="w-full text-md font-bold bg-red-500 transition duration-500 ease-in-out hover:bg-red-600 rounded-md p-1">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./main.js"></script>

</html>