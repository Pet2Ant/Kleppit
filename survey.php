<?php


session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    include "databasecon/dbcon.php";
    include "survey/surveyresults.php";

    $id = $_SESSION["id"];
    $fname =    htmlspecialchars($_POST["fname"], ENT_QUOTES, 'UTF-8');
    $lname = htmlspecialchars($_POST["lname"], ENT_QUOTES, 'UTF-8');
    $age = htmlspecialchars($_POST["age"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $recKleppit = htmlspecialchars($_POST["user_answer"], ENT_QUOTES, 'UTF-8');
    $Job = htmlspecialchars($_POST["job"], ENT_QUOTES, 'UTF-8');
    $overallFeel = htmlspecialchars($_POST["comments"], ENT_QUOTES, 'UTF-8');


    $survey = new Survey();
    $survey->survey($id, $fname, $lname, $age, $email, $recKleppit, $Job, $overallFeel);



   
    header('location:public/index.php');
}





?>
