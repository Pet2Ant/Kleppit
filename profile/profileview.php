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
    public function fetchIntroduction($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        echo $profileInfo[0]["profiles_introduction"];
    }

}
?>