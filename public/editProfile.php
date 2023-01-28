<?php session_start();
include "../databasecon/dbcon.php";
include "../profile/profileinfo.php";
include "../profile/profilecontr.php";
include "../profile/profileview.php";
include '../components/navbar.php';
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
    <!-- Nav Bar -->
    <?php
        $navbar = new Navbar();
        $navbar->genereElement();
    ?>

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