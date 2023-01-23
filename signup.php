<?php
//checking connection
if(isset($_POST["submit"]))
{
    
    //getting the user data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    include "databasecon\dbcon.php";
    include "signup\signupquery.php";
    include "signup\signuperror.php";
    
    
    $signup = new Signup($username,$email,$password,$confirm);
    //errors
    $signup->signupUser();
    

    header('location:public/index.php');

}
?>