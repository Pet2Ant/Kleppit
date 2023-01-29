<?php
//checking connection
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    //getting the user data and signing him up 
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    $confirm = htmlspecialchars($_POST["confirm"], ENT_QUOTES, 'UTF-8');
    //connect to the database 
    include "databasecon\dbcon.php";
    //connect to the sign up classes
    include "signup\signupquery.php";
    include "signup\signuperror.php";
    //create new signup obj
    $signup = new Signup($username,$email,$password,$confirm);
    //error handling 
    $signup->signupUser();
    //Create new user profile 
    $id = $signup->fetchUserId($username);
    include "profile\profileinfo.php";
    include "profile\profilecontr.php";
    include "profile\profileview.php";
    $pfp = "defaultavatar.png";
    $profileInfo = new ProfileInfoController($id,$username,$pfp);
    $profileInfo->defaultProfileInfo();
    header('location:public/loginform.php');

}
?>