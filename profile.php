
<?php

session_start();
$id= $_SESSION["id"] ;
$username = $_SESSION["username"];
     function fuckMyexistence(){
if($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
    include "databasecon/dbcon.php";
    include "profile/profileinfo.php";
    include "profile/profilecontr.php";
    include "profile/profileview.php";
    
    $profileInfo = new ProfileInfoController($username,$id);
    $placeholder = "this is a text";
    $profileInfo->updateProfileInfo($description, $name,$placeholder);
    

    
}
}


?>