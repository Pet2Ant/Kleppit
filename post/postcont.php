<?php

class PostContr extends PostInfo
{
    private $post_title;
    private $post_content;
    private $id;

    public function __construct($post_title,$post_content,$id)
    {
        $this -> id = $id;
        $this -> post_title = $post_title;
        $this -> post_content = $post_content;
    }
    public function newPost()
    {
        
        $this->createPost($this->post_title,$this->post_content,$this->id);
       
        
    }   

    public function updateExistingPost($post_title,$post_content,$id)
    {
        //error handlers
        if($this->emptyInputsCheck($post_title,$post_content,$id))
        {
            header('Location:public/profilesettings.php?error=emptyinput');
            exit();
        }
        //update profile info
        $this->updatePost($post_title,$post_content, $this->id);

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