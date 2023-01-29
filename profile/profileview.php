<?php

class ProfileInfoView extends ProfileInfo
{
    public function fetchAbout($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        echo $profileInfo[0]["profiles_about"];
    }
    public function fetchTitle($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        echo $profileInfo[0]["profiles_title"];
    }
    public function fetchDate($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        echo substr($profileInfo[0]["joined_at"], 0, 10);
    }
    public function fetchIntroduction($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        echo $profileInfo[0]["profiles_introduction"];
    }
    public function fetchPostKarma($id)
    {
        return $this->getUserPostKarma($id);
        
    }
    public function fetchCommentKarma($id)
    {
        return $this->getUserCommentKarma($id);
    }
    public function fetchAvatar($id)
    {
        return $this->getAvatar($id);
    }
    public function updateAvatar($id,$newPfp)
    {
        $this->updatesAvatar($id,$newPfp);
    }

    

}
?>