<?php

class PageInfo extends PostInfo
{
    public function getPostInfo($postid)
    {
        return $this->getPost($postid);
    }

}


?>
