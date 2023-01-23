<?php

class Signup extends SignupDb
{
    private $username;
    private $email;
    private $password;
    private $confirm;
  

    public function __construct($username,$email,$password,$confirm)
    {
        $this -> username =  $username;
        $this -> email=  $email;
        $this -> password =  $password;
        $this -> confirm =  $confirm;
       
    }

    public function signupUser()
    {
        if($this->emptyInput() )
        {
            echo "empty input";
            
            exit();
        }
        if($this->invalidUsername() ==false )
        {

            echo "invalid username";
          
            exit();
        }
        if($this->invalidEmail() == false)
        {
             echo "invalid emailL";
            
            exit();
        }
        if($this->invalidPassword() == false)
        {
             echo " invalid password ";
             
            exit();
        }
        if($this->passwordMatch() == false)
        {
            echo "password dont match ";
           
            exit();
        }
        if($this->alreadyExists() == false)
        {
             echo "username or email already has an account";
            
            exit();
        }
        $this->setUser($this->username,$this->email,$this->password);

    }
    //error handle empty username password etc

    private function emptyInput()
    {
        //all the fields are not empty
        if(empty($this->username)  ||  empty($this->email)  ||  empty($this->password)  ||  empty($this->confirm) )
        {
            
                return true;
        }
        return false;
    }
    //invalid username(can use a-z , A-z , 0-9, no special chars)
    private function invalidUsername()
    {
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->username))
        {
            
            return false;
        }
        return true;
    
    }
    //invalid email check
     private function invalidEmail()
    {
        if(!filter_var($this->email , FILTER_VALIDATE_EMAIL)) {return false;}
        return true;

    }
    // matching passwords 
    private function passwordMatch()
    {
        if($this->password !== $this->confirm)
        {
            return false;
        }
        return true;
    }
    // invalid password (one upper one lower one number one special bigger than 8)
    private function invalidPassword()
    {
        
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        $specialChars = preg_match('@[^\w]@', $this->password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || (strlen($this->password) < 8))
        {
            
            return false;
        }
        return true;
    }
    // does the username or email already exist in the DB
    private function alreadyExists()
    {
        if(!$this->checkUsernameEmail($this->username,$this->email))
        {
            return false;
        }
        return true;
    }

}



?>
