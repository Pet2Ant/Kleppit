
<?php

session_start();

    
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $id= $_SESSION["id"] ;
    $username = $_SESSION["username"];
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
    include "databasecon/dbcon.php";
    include "profile/profileinfo.php";
    include "profile/profilecontr.php";
    include "profile/profileview.php";
    include "signup\signupquery.php";
    include "signup\signuperror.php";
    $signup = new Signup($username,$email,$password,$confirm);
    $profileInfo = new ProfileInfoController($id,$username,$pfp);
    
    
    $profileInfo->updateProfileInfo($description, $name);
    header('location:public/profile.php');
    
    
}



?>