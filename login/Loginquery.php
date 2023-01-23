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
            echo "<h6>"."fuck"."</h6>";
        }
        if ($input->rowCount() == 0)
        {
            $input = null;
            // header("location:../index.php?error=usernotfound");
            // exit();
            echo "<h6>"."user not found"."</h6>";
        }
        $passwordhashed = $input->fetchAll(PDO::FETCH_ASSOC);
        $checkpassword = password_verify($pwd, $passwordhashed[0]["users_pwd"]);
        

        if($checkpassword == false )
        {
           $input = null;
        //    header("location:../index.php?error=wrongpassword");
        //    exit();
            echo "<h6>"."wrong pass"."</h6>";
        }
        elseif($checkpassword  == true) {

            $input = $this->connect()->prepare('SELECT * FROM users WHERE username = ? OR email =? AND users_pwd=?;');
            if (!$input->execute(array($username, $username, $passwordhashed[0]["users_pwd"]))) {
                $input = null;
                echo "<h6>"."everythign went to shit"."</h6>";
                // header("location:../index.php?error=smthingfailed");
                // exit();
            }
        if (!$input->rowCount() == 0) {
            echo "<h6>" . "FUCKMYFUCKINGLIFE" . "</h6>";
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