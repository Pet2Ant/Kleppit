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
        $profileTitle = "Hello, I am".$this->username;
        $profileText = "Say more things about yourself here";
        $this->setProfileInfo($profileAbout, $profileTitle, $profileText, $this->id);
        
    }   

}
?>