<?php


session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    include "databasecon/dbcon.php";
    include "survey/surveyresults.php";
    // initialize variables 
    $id = $_SESSION["id"];
    $fname =    htmlspecialchars($_POST["fname"], ENT_QUOTES, 'UTF-8');
    $lname = htmlspecialchars($_POST["lname"], ENT_QUOTES, 'UTF-8');
    $age = htmlspecialchars($_POST["age"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $recKleppit = htmlspecialchars($_POST["user_answer"], ENT_QUOTES, 'UTF-8');
    $Job = htmlspecialchars($_POST["job"], ENT_QUOTES, 'UTF-8');
    $overallFeel1 = htmlspecialchars($_POST["comments1"], ENT_QUOTES, 'UTF-8');
    $overallFeel2 = htmlspecialchars($_POST["comments2"], ENT_QUOTES, 'UTF-8');
    $overallFeel3 = htmlspecialchars($_POST["comments3"], ENT_QUOTES, 'UTF-8');
    $overallFeel4 = htmlspecialchars($_POST["comments4"], ENT_QUOTES, 'UTF-8');
    // what part needs upgrade if statement so we only input once in the DB 
    $str = "";

    if ($overallFeel1) 
    {
        $str = $str . "1";
    } else 
    {
        $str = $str . "0";
    }
    if ($overallFeel2) 
    {
        $str = $str .  "1";
    } else 
    {
        $str = $str . "0";
    }
    if ($overallFeel3) 
    {
        $str = $str .  "1";
    } else 
    {
        $str = $str . "0";
    }
    if ($overallFeel4) 
    {
        $str = $str .  "1";
    } else 
    {
        $str = $str . "0";
    }
    

    // add the survey to the DB
    $survey = new Survey();
    $survey->survey($id, $fname, $lname, $age, $email, $recKleppit, $Job, $str);

    header('location:public/index.php');
}





?>
