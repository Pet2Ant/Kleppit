<?php


class ImageCont extends Image 

{
    private $image;
    private $name ;
    private $tmpname ;
    private $fileSize ;
    private $fileError ;
    private $fileType ;
    
    public function _construct($image, $name ,$tmpname ,$fileSize ,$fileError ,$fileType )

    {
        $this-> image = $image;
        $this-> name = $name;
        $this-> tmpname = $tmpname;
        $this-> fileSize = $fileSize;
        $this-> fileError = $fileError;
        $this-> fileType = $fileType;
    }

    public function uploadImage()
    {
        //check file size
        if($this->checkFileError() == true)
        {
            echo " failed uploading the image";
            // header('location=');
            // exit();
        }
        // check file type
        if($this->checkType() ==  false )
        {
            echo " wrong type";
            // header('location=');
            // exit();
        }
        if($this->tooBigImage())
        {
            echo " image too big ";
            // header('location=');
            // exit();
        }
        $fileExt = explode('.',$this->name);
        $fileExactExt = strtolower(end($fileExt));
        $fileNewName = "userimages" . $id . $fileExactExt;

    }
    private function checkType()
    {
        $fileExt = explode('.',$this->name);
        $fileExactExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if(!(in_array($fileExactExt,$allowed)))
        {
            return false;
        }
        return true;
    }

    private function checkFileError()
    {
        if($this->fileError === 0)
        {
            return true;
        }
        return false;
    }
    private function tooBigImage()
    {
        if($this->fileSize > 1000000)
        {
            return true;
        }
        return false;

    }
    
}
?>
