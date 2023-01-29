<?php
session_start();
include '../components/navbar.php';
include "../databasecon/dbcon.php";
include '../post/searchsql.php';

$search = new SearchSQL();

//Define queries
$searchQuery = null;
$pageQuery = null;
$orderQuery = null;
$sortingColumn = null;
$sortingColumnQuery = null;
$sortingOrderQuery = null;

//Check if the search query is empty
if (empty($_GET['query'])) {
    //If it is, redirect to the homepage
    header("Location: ./");
    exit();
} else {
    $searchQuery = $_GET['query'];
}


//Check if the page query is empty
if (empty($_GET['page'])) {
    //If it is, set it to 1
    $pageQuery = 1;
} else {
    $pageQuery = $_GET['page'];
};

//Check if the sort query is empty
if (empty($_GET['sort'])) {
    //If it is, set it to date
    $sortingColumnQuery = "date";
} else {
    if ($_GET['sort'] == "date") {
        $sortingColumnQuery = "date";
    } else if ($_GET['sort'] == "karma") {
        $sortingColumnQuery = "post_karma";
    } else {
        $sortingColumnQuery = "date";
    }
};

//Check if the order query is empty
if (empty($_GET['order'])) {
    //If it is, set it to asc
    $orderQuery = "ASC";
    $sortingOrderQuery = "ASC";
} else {
    $orderQuery = $_GET['order'];
    $sortingOrderQuery = $_GET['order'];
};

//Prevent SQL injection by escaping the search query
$searchQuery = htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8');

//Define the number of results per page
$resultsPerPage = 10;

//Define the offset
$offset = ($pageQuery - 1) * $resultsPerPage;

//Define the sorting column
$sortingColumn = $sortingColumnQuery;

//Define the sorting order
$sortingOrder = $orderQuery;

//Perform the search query

$sqlQuery = "SELECT * FROM post p INNER JOIN users u ON u.id = p.users_id WHERE post_title LIKE '%$searchQuery%' OR post_content LIKE '%$searchQuery%' ORDER BY $sortingColumn $sortingOrder LIMIT $offset, $resultsPerPage ;";
$searchResults = $search->search($sqlQuery);

//Get all the results so we can know how many pages there are
$sqlQuery = "SELECT * FROM post p INNER JOIN users u ON u.id = p.users_id WHERE post_title LIKE '%$searchQuery%' OR post_content LIKE '%$searchQuery%' ORDER BY $sortingColumn $sortingOrder;";

//Define the number of results
$allResults = $search->search($sqlQuery);

$numResults = null;
if ($searchResults == null) {
    //Make numResults an empty array
    $searchResults = array();
} else {
    //Define the number of results
    $numResults = count($searchResults);
}

$numAllResults = null;
if ($allResults == null) {
    //Make numResults an empty array
    $allResults = array();
} else {
    //Define the number of results
    $numAllResults = count($allResults);
}


//Define the number of pages
$numPages = ceil($numAllResults / $resultsPerPage);

//Define the current page
$currentPage = $pageQuery;

//Define the previous page
$previousPage = $currentPage - 1;

//Define the next page
$nextPage = $currentPage + 1;

//Define the last page
$lastPage = $numPages;

//Define the first page
$firstPage = 1;

$buttonDate = "Date";
$buttonKarma = "Karma";

if ($sortingOrderQuery == "DESC") {
    $buttonDateFunction = "ASC";
    $buttonKarmaFunction = "ASC";
} else {
    $buttonDateFunction = "DESC";
    $buttonKarmaFunction = "DESC";
}

//Handle buttons
switch ($sortingColumn) {
    case "date":
        if ($sortingOrderQuery == "DESC") {
            $buttonDate = "Date ↓";
        } else {
            $buttonDate = "Date ↑";
        }
        break;
    case "post_karma":
        if ($sortingOrderQuery == "DESC") {
            $buttonKarma = "Karma ↓";
        } else {
            $buttonKarma = "Karma ↑";
        }
        break;
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
    <div id="container" class=" container mx-auto">
        <div class="flex w-960 mx-auto h-screen">
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

                <div class="mt-3">
                    <span class="text-xl lg:inline-block hidden font-semibold text-gray-500 p-2">Showing all posts matching '<span class="ml-0.5 text-lg text-red-500 "><?php echo $_GET['query']; ?></span>'</span>
                </div>

                <?php if ($numResults > 0) { ?>
                    <div class="mt-3">
                        <span class="text-md text-gray-500">Sort by:</span>
                        <button  onclick="javascript:window.location.href='./search.php?query=<?php echo $_GET['query']; ?>&sort=date&order=<?php echo $buttonDateFunction; ?>'" class="px-4 py-2 font-medium text-red-500 border border-red-500 rounded-l-md hover:bg-red-500 hover:text-black transition duration-500 ease-in-out">
                            <?php echo $buttonDate; ?>
                        </button>
                        <button onclick="javascript:window.location.href='./search.php?query=<?php echo $_GET['query']; ?>&sort=karma&order=<?php echo $buttonKarmaFunction; ?>'"  class="px-4 py-2 font-medium text-red-500 border border-red-500 rounded-r-md hover:bg-red-500 hover:text-black transition duration-500 ease-in-out">
                            <?php echo $buttonKarma; ?>
                        </button>
                    </div>
                <?php } ?>
            </div>
            
            <!-- Posts -->
            <?php

                if ($numResults == 0) {
                    echo '
                        <div class="flex flex-col justify-center items-center mt-10">
                            <div class="text-4xl text-gray-500 font-bold">No results found</div>
                            <div class="text-2xl text-gray-500 font-bold">Try searching for something else</div>
                        </div>
                    ';
                }

                for ($i = 0; $i < $numResults; $i++) {
                    echo '
                        <div id="" class="py-2 mb-4">
                            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                                <div class="w-5 mx-4 flex flex-col text-center pt-2"> 
                                    <div onclick="javascript:window.location.href=\'../public/page.php?p=' . $searchResults[$i]['post_id'] . '\'"><p style="opacity: 0;">-</p></div>
                                    <div class="text-red-500 font-bold text-lg">' . $searchResults[$i]['post_karma'] . '</div>
                                    <div onclick="javascript:window.location.href=\'../public/page.php?p=' . $searchResults[$i]['post_id'] . '\'"><p style="opacity: 0;">-</p></div>
                                </div>
                                <!-- Post Information -->
                                <div class="w-11/12 pt-2" onclick="javascript:window.location.href=\'../public/page.php?p=' . $searchResults[$i]['post_id'] . '\'">
                                
                                    <div class="flex items-center text-xs mb-2">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="../public/Profile.php' . $searchResults[$i]['username'] . '" class="text-gray-500 mx-1 no-underline hover:underline">ku/' . $searchResults[$i]['username'] . '</a>
                                        <span class="text-gray-500">' . $searchResults[$i]['date'] . '</span>
                                    </div>
                                    <!-- Post Title -->
                                    <div>
                                        <h2 class="text-lg font-bold mb-1 text-gray-400 break-all">
                                        ' . $searchResults[$i]['post_title'] . '
                                        </h2>
                                    </div>
                                    <!-- Post Description -->
                                    <p class="text-gray-500 break-all">
                                        ' . $searchResults[$i]['post_content'] . '

                                    </p>
                                    <!-- Comments -->
                                    <div class="inline-flex items-center my-1">
                                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                            <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                            </svg>
                                            <span class="ml-2 text-xs font-semibold text-gray-500">Comments</span>
                                        </div>                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }

            ?>

            <!-- Pagination -->
            <div class="mt-3 flex justify-between">
                <span class="text-md text-gray-500">Display results: <?php
                // show which results are being displayed
                if ($numResults > 0) {
                    $startResult = ($pageQuery - 1) * $resultsPerPage + 1;
                    $endResult = $startResult + $numResults - 1;
                    echo $startResult . ' - ' . $endResult . ' of ' . $numAllResults;
                } 
                ?>
                </span>

                    <?php 
                    echo '<div class="space-x-4">
                    <span class="ml-0.5 text-lg font-semibold text-gray-500 ">Go to:</span>';
                                       
                        for ($i = 1; $i <= $numPages; $i++) {

                            if ($i == $pageQuery) {
                                echo '
                                
                                
                                    <button onclick="javascript:window.location.href=\'./search.php?query=' . $_GET['query'] . '&page=' . $i . '&sort=' . $sortingColumn . '&order=' . $sortingOrder . '\'" class="px-4 py-2 font-medium text-white bg-red-500 border border-red-500 rounded-md hover:bg-white-500 hover:text-black transition duration-500 ease-in-out">
                                        ' . $i . '
                                    </button>
                                    
                                ';
                                continue;
                            } 

                            echo '
                                <button onclick="javascript:window.location.href=\'./search.php?query=' . $_GET['query'] . '&page=' . $i . '&sort=' . $sortingColumn . '&order=' . $sortingOrder . '\'" class="px-4 py-2 font-medium text-red-500 border border-red-500 rounded-md hover:bg-red-500 hover:text-black transition duration-500 ease-in-out">
                                    ' . $i . '
                                </button>
                            ';
                        
                        }
                        echo '</div>';

                    ?>
                </div>
                <br>

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
</body>
<script src="./main.js"></script>

</html>