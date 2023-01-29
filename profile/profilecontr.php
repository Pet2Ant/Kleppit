<?php

class ProfileInfoController extends ProfileInfo
{
    private $id;
    private $username;
    private $pfp;

    public function __construct($id,$username,$pfp)
    {
        $this -> id = $id;
        $this -> username = $username;
        $this-> pfp = $pfp;
    }
    public function defaultProfileInfo()
    {
        $profileAbout =" Tell users something about yourself";
        $profileTitle = "Hello, I am ".$this->username;
        $this->setProfileInfo($profileAbout, $profileTitle,$this->pfp, $this->id);
        
    }   

    public function updateProfileInfo($about,$intro)
    {
        //error handlers
        if($this->emptyInputsCheck($about,$intro))
        {
            header('Location:public/profile.php');
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