<?php

class ProfileInfoController extends ProfileInfo
{
    private $id;
    private $username;

    public function __construct($id,$username)
    {
        $this -> id = $id;
        $this -> username = $username;
    }
    public function defaultProfileInfo()
    {
        $profileAbout =" Tell users something about yourself";
        $profileTitle = "Hello, I am ".$this->username;
       
        $this->setProfileInfo($profileAbout, $profileTitle, $this->id);
        
    }   

    public function updateProfileInfo($about,$intro,)
    {
        //error handlers
        if($this->emptyInputsCheck($about,$intro))
        {
            header('Location:public/profilesettings.php?error=emptyinput');
            exit();
        }
        //update profile info
        $this->setNewProfileInfo($about, $intro,  $this->id);

    }
    private function emptyInputsCheck($about,$intro)
    {
        if(empty($about) || empty($intro)  )
        {
            return true;
        }
        return false;
    }
}
?>