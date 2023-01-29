<?php

class SignupDb extends DbCon
{
    protected function setUser($username,$email,$password)
    {
        $input = $this->connect()->prepare('INSERT INTO users (username,email,users_pwd) VALUES (?,?,?);');
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        if(!$input->execute(array($username,$email,$hashedpassword)))
        {
            $input = null;
            header("location:../index.php?signup=checkdberror");
            exit();

        }
        $input = null;

    }
    protected function checkUsernameEmail($username,$email)
    {
        $checkdb = $this->connect()->prepare('SELECT username FROM users WHERE username = ? OR email = ?;');

        if(!$checkdb->execute(array($username,$email)))
        {
            $checkdb = null;
            header("location:../index.php?signup=checkdberror");
            exit();
        }
        if($checkdb->rowCount() > 0)
        {
            return false;
        }
        return true;
    }
    protected function getUserId($username)
    {
        $stmt = $this -> connect()->prepare('SELECT id FROM users where username= ?;');
        if(!$stmt->execute(array($username)))
        {
            $stmt = null;
            header('location: profile.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header('location: profile.php?error=profilenotfound');
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;

    }
    
    

}

?>