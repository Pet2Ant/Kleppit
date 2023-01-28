<?php
include "../databasecon/dbcon.php";
include '../post/searchsql.php';

$search = new SearchSQL();

//Define queries
$searchQuery = null;
$pageQuery = null;
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
    //If it is, set it to ""
    $sortQuery = "";
} else {
    $sortingColumnQuery = $_GET['sort'];
};

//Check if the order query is empty
if (empty($_GET['order'])) {
    //If it is, set it to ""
    $orderQuery = "";
} else {
    $sortingOrderQuery = $_GET['order'];
};

//Prevent SQL injection by escaping the search query
$searchQuery = htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8');

//Define the number of results per page
$resultsPerPage = 10;

//Define the offset
$offset = ($pageQuery - 1) * $resultsPerPage;

//Define the sorting column
$sortingColumn = "post_id";

//Define the sorting order
$sortingOrder = "DESC";

//Perform the search query
$searchQuery = $search->search("SELECT * FROM post WHERE post_title LIKE '%$searchQuery%' OR post_content LIKE '%$searchQuery%' ORDER BY $sortingColumn $sortingOrder LIMIT $offset, $resultsPerPage;");

if ($searchQuery == null) {
    //If the search query is empty, redirect to the homepage
    echo "No results found";
    exit();
}

//Define the number of results
$numResults = count($searchQuery);

//Define the number of pages
$numPages = ceil($numResults / $resultsPerPage);

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

//Return the results
print_r($searchQuery);
