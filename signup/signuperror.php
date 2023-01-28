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
            
            header('Location:public/signupform.php?signup=empty');
            exit();
        }
        if($this->invalidUsername() ==false )
        {

            
            header('Location:public/signupform.php?signup=invalidusername');
            exit();
        }
        if($this->invalidEmail() == false)
        {
            
            header('Location:public/signupform.php?signup=invalidemail');
            exit();
        }
        if($this->invalidPassword() == false)
        {
           
            header('Location:public/signupform.php?signup=invalidpassword');
            exit();
        }
        if($this->passwordMatch() == false)
        {
            
            header('Location:public/signupform.php?signup=passwordDoesntMatch');
            exit();
        }
        if($this->alreadyExists() == false)
        {
            
             header('Location:public/signupform.php?signup=alreadyexists');
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
    public function fetchUserId($username)
    {
        $id = $this->getUserId($username);
        return $id[0]["id"];
    }

}



?>
