
<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
    include "databasecon/dbcon.php";
    include "profile/profileinfo.php";
    include "profile/profilecontr.php";
    include "profile/profileview.php";

    $username = $_SESSION["username"];
    $id = $_SESSION["id"];
    $profileInfo = new ProfileInfoController($username,$id);
    $placeholder = "this is a text";
    $profileInfo->updateProfileInfo($description, $name,$placeholder );
    header('location:public\Profile.php');

    
} 
?>