<?php

class PostInfoView extends PostInfo
{
    public function fetchTitle($id)
    {
        $postInfo = $this->getUserInfo($id);
        echo $postInfo[0]["post_title"];
    }
    public function fetchContent($id)
    {
        $postInfo = $this->getUserInfo($id);
        echo $postInfo[0]["post_content"];
    }
    

}
?>