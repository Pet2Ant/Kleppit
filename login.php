
<?php

//checking connection
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //getting the user data
    $username = htmlspecialchars($_POST["emailorusername"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
    include "databasecon\dbcon.php";
    include "login\loginsql.php";
    include "login\loginerrors.php";
    



    $login = new LoginEr($username, $pwd);
    //errors
    $login->loginUser();
    header('location:public/index.php');
} 
     
?>
