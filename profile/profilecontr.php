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
        $profileText = "0";
        $this->setProfileInfo($profileAbout, $profileTitle, $profileText, $this->id);
        
    }   

    public function updateProfileInfo($about,$intro,$text)
    {
        //error handlers
        if($this->emptyInputsCheck($about,$intro,$text))
        {
            header('Location:public/profilesettings.php?error=emptyinput');
            exit();
        }
        //update profile info
        $this->setNewProfileInfo($about, $intro, $text, $this->id);

    }
    private function emptyInputsCheck($about,$intro,$text)
    {
        if(empty($about) || empty($intro) || empty($text))
        {
            return true;
        }
        return false;
    }
}
?>