<?php
session_start();
include '../components/navbar.php';

$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$postId = $_SERVER["QUERY_STRING"];
parse_str($postId, $postId);
if (!$postId) {
    echo "page doesnt exist";
    exit();
}
$postId = $postId["p"];



include "../databasecon/dbcon.php";
include "../post/postsql.php";
include "../post/postcont.php";
include "../post/pageview.php";
include "../post/postview.php";
$post = new PageInfo();
$postInfo =  $post->getPostInfo($postId);
$comCount = new PostInfo();

if (empty($postInfo)) {
    echo "Post not found or deleted";
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
Red text: text-red-500 hover:text-red-600
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
                                    <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                                    </svg>
                                </button>
                                <!-- Vote count -->
                                <span class="text-xs font-semibold my-1 text-gray-500"><?php echo $postInfo["post_karma"]; ?></span>
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
                                    <span class="text-gray-500">Posted by </span>
                                    <a href="./Profile.php?u=<?php echo $postInfo["username"] ?>" class="text-gray-500 mx-1 no-underline hover:underline">ku/<?php echo $postInfo["username"] ?></a>
                                    <span class="text-gray-500"><?php echo $postInfo["date"] ?></span>
                                </div>
                                <!-- Post Title -->
                                <div>
                                    <h2 class="text-lg font-bold mb-1 text-gray-300 break-all">
                                        <?php echo $postInfo["post_title"]; ?>
                                    </h2>
                                </div>
                                <!-- Post Description -->
                                <p class="text-gray-400 break-all">
                                    <?php if ($postInfo["postimage"] == 0) {
                                        echo $postInfo["post_content"];
                                    } else {
                                        echo '<img src="../uploads/' . $postInfo["post_content"] . '" alt="no pic found" width="400" height="240">';
                                    }?>

                                </p>

                                <!-- Post Actions -->
                                <div class="inline-flex items-center my-1 ">
                                    <div class="flex p-1 rounded-lg">
                                        <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                        </svg>
                                        <span class="ml-2 text-xs font-semibold text-gray-500"><?php echo count($comCount->getCommentsCountFromPost($postId))?> Comments</span>
                                    </div>
                                </div>
                                <hr class="border-b-1 border-zinc-700 mx-auto">
                            </div>

                        </div>
                         <?php if ($_SESSION) { ?>
                        <div class="relative w-11/12 mx-auto py-10 min-w-[200px] border-b-1 border-zinc-700 border-dashed ">
                            <div class="pb-1">
                                <label for="textArea" class="text-sm text-gray-500 ">
                                    Comment as <a class="no-underline hover:underline" href="./Profile.php">ku/<?php

                                    echo $_SESSION["username"];

                                    ?></label></a>
                            </div>
                            <form action="../comment.php" method="post">
                                <input type="text" name="post_id" value="<?php echo $postId ?>" hidden>
                                <textarea id="textArea" name="comment" placeholder="Share your thoughts" type="text" class="resize-y text-sm block  px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-600 focus:outline-none"></textarea>
                                <div class="flex justify-end">
                                    <button type="submit" name="submit" class="mt-3 w-32 bg-red-600 text-white active:bg-red-600 text-sm font-semibold uppercase px-2 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none  ease-linear transition duration-150 ease-in-out hover:bg-red-700">
                                        Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                        <?php } else {
                             echo '<button  onclick="javascipt:window.location.href=\'./loginform.php\'"   class="button rounded-lg  font-bold text-black bg-red-500   px-4 py-2 my-2 ml-6 transition duration-500 ease-in-out  hover:bg-red-600" role="menuitem">Log in to comment</button>';
                         } ?>
                                
                        

                        <hr class="border-t-1 border-zinc-700">
                    </div>


                    <div class="flex justify-center mb-5 mx-5 ">
                        <div class="flex flex-col space-y-3 min-w-full">


                            <!-- Comment Body -->

                            <?php
                            $comments = new PostInfoView();

                            if($_SESSION){
                              $comments->fetchComment($postId,$_SESSION['id']);
                            }else{
                              $comments->fetchComment($postId,-1);
                            }
                            ?>

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