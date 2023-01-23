<?php

class Login extends DbCon
{
    protected function getUser($username,$pwd)
    {
        $input = $this->connect()->prepare('SELECT users_pwd FROM users WHERE username = ? OR email =?');
       
        if(!$input->execute(array($username,$username)))
        {
            $input = null;
            // header("location:../index.php?error=checkdberror");
            // exit();
           
        }
        if ($input->rowCount() == 0)
        {
            $input = null;
            // header("location:../index.php?error=usernotfound");
            // exit();
        }
        $passwordhashed = $input->fetchAll(PDO::FETCH_ASSOC);
        $checkpassword = password_verify($pwd, $passwordhashed[0]["users_pwd"]);
        

        if($checkpassword == false )
        {
           $input = null;
        //    header("location:../index.php?error=wrongpassword");
        //    exit();
           
        }
        elseif($checkpassword  == true) {

            $input = $this->connect()->prepare('SELECT * FROM users WHERE username = ? OR email =? AND users_pwd=?;');
            if (!$input->execute(array($username, $username, $passwordhashed[0]["users_pwd"]))) {
                $input = null;
                
                // header("location:../index.php?error=smthingfailed");
                // exit();
            }
        if (!$input->rowCount() == 0) {
            $user = $input->fetchAll(PDO::FETCH_ASSOC);
            echo $user;
            session_start();
            $_SESSION["id"] = $user[0]["id"];
            $_SESSION["username"] = $user[0]["username"];
            $input = null;
        }
        
    }
    }
   
}

?>