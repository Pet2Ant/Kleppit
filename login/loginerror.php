<?php

class LoginEr extends Login
{
    private $username;
    private $pwd;
    


    public function __construct($username,$pwd)
    {
        $this -> username =  $username;
        $this -> pwd =  $pwd;
      
    }

    public function loginUser()
    {
        if($this->emptyInput() == false)
        {
            echo "empty input";
            // header('location:../index.php?error=emptyinput');
            // exit();
        }
        $this->getUser($this->username,$this->pwd);

    }
    //error handle empty username password etc

    private function emptyInput()
    {
        //all the fields are not empty
        if(empty($this->username)  ||  empty($this->pwd)  )
        {
                return false;
        }
        return true;
    }
 

}



?>
