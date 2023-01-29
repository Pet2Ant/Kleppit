<?php
session_start();
include "../databasecon/dbcon.php";
include "../profile/profileinfo.php";
include "../profile/profilecontr.php";
include "../profile/profileview.php";
include "../post/postsql.php";
include "../post/postcont.php";
include "../post/postview.php";
include '../components/navbar.php';
$profileInfo = new ProfileInfoView();
$postInfo = new PostInfoView();
$user_id = -1;

//Check if url query has the username
if (isset($_GET["u"])) {
    //TODO fetch user info from database
    $userInfo = $postInfo->getUserByName($_GET["u"]);

    //Check if user exists
    if ($userInfo == null) {
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
    if ($_SESSION) 
    {
        $user_id = $_SESSION["id"];
        $user_username = $_SESSION["username"];
        $user_email = $_SESSION["email"];
    }else
    {
        header("location:loginform.php");
        exit();
    }

}
// echo $user_id;





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
            <div class="py-2 mb-4 ">
                <div class="flex justify-start flex-row mb-3 ml-5">
                    <!-- Posts button to display all posts -->
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="button" id="textButton" onclick="javascript:window.location.href='./Profile.php?u=<?php echo $user_username ?>'" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-red-600 transition duration-300 ease-in-out">
                            Posts
                        </button>
                    </span>
                    <!-- Comments button to display all comments -->
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="button" id="imageButton" onclick="javascript:window.location.href='./ProfileComments.php?u=<?php echo $user_username ?>'" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-red-500 bg-zinc-800 hover:text-red-600 focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-red-600 transition duration-300 ease-in-out hover:bg-red-600 hover:text-white">
                            Comments
                        </button>
                    </span>
                </div>


                <div class="flex w-960 mx-auto">
                    <!-- Posts -->
                    <div class="w-11/12 ml-5">
                        <?php
                        //Display user posts
                        $postInfo->createPostFe($user_id);
                        ?>
                    </div>
                    <!--  Sidebars -->
                    <div class="w-1/3 pl-9 hidden lg:block">
                        <div class="py-2">
                            <div class="flex justify-center items-center bg-zinc-900">
                                <div class="w-80 pb-2 border border-gray-500 rounded-lg overflow-hidden">
                                    <div class="p-3 bg-[url('../assets/kleppit-high-resolution-logo-white-on-black-background-cropped.png')] bg-contain object-cover h-16"></div>
                                    <div class="flex justify-center avatar">
                                        <div class="w-48 ">
                                        
                                        <?php echo '<img class="border-2 my-5 border-red-500 rounded-full" alt="no pic" src="../avatars/'.$profileInfo->fetchAvatar($user_id)[0]['profile_pic'].'">' ?>
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
                                    <div class="flex justify-center items-center py-1">
                                        <p class="text-xs text-gray-400 font-bold">Post Karma: <?php if ($profileInfo->fetchPostKarma($user_id)[0]["SUM(post_karma)"] == 0) {
                                            echo 0;
                                        } else {
                                            echo $profileInfo->fetchPostKarma($user_id)[0]["SUM(post_karma)"]; }  ?> 
                                        Comment Karma: <?php if ($profileInfo->fetchCommentKarma($user_id)[0]["SUM(c_karma)"] == 0) {
                                            echo 0;
                                        } else {
                                            echo $profileInfo->fetchCommentKarma($user_id)[0]["SUM(c_karma)"]; } ?></p>
                                    </div>
                                    <!-- Profile Button -->
                                    <div class="flex justify-center items-center py-1">
                                        <?php
                                        if($_SESSION)
                                            {
                                                if($user_id == $_SESSION["id"])
                                                {
                                                    echo '<button onclick="javascript:window.location.href =\'./editProfile.php\'" class="w-40 text-sm font-bold bg-gray-300 transition duration-500 ease-in-out hover:bg-gray-400 rounded-full p-1">
                                                    Edit Profile
                                                    </button>';
                                                }
                                            }
                                        ?>
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
                                    <div class="flex justify-center">
                                        <div>
                                            <a href="./ContactUs.php" class="block no-underline text-xs font-semibold text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">Contact Us</a>
                                        </div>
                                    </div>
                                    <div class="text-center mt-6">
                                        <p class="text-xs leading-tight text-gray-400 font-medium">
                                            <a href="./userAgreement.php" class="no-underline text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">User Agreement</a>
                                            |
                                            <a href="./PrivacyPolicy.php" class="no-underline text-gray-400 transition duration-500 ease-in-out hover:text-gray-500">Privacy Policy</a>
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