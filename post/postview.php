<?php

class PostInfoView extends PostInfo
{
    private function upvoteCreator($isClicked)
    {
        if ($isClicked == true) {
            return '<button type="submit" name="upvote" class="text-xs">
                    <svg class="w-5 fill-current  text-red-500 "xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                    </svg>
                </button>';
        }
        return '<button type="submit" name="upvote" class="text-xs">
        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
        </svg>
        </button>';
    }

    private function downvoteCreator($isClicked)
    {
        if ($isClicked == true) {
            return '<button type="submit" name="downvote" class="text-xs">
            <svg class="w-5 fill-current text-blue-500 "xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
            </svg>
            </button>';
        }
        return '<button type="submit" name="downvote" class="text-xs">
        <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
        </svg>
        </button>';
    }

    public function fetchTitle($id)
    {
        $postInfo = $this->getUserPosts($id);
        echo $postInfo[0]["post_title"];
    }

    public function fetchContent($id)
    {
        $postInfo = $this->getUserPosts($id);
        echo $postInfo[0]["post_content"];
    }

    public function createPostFe($id)
    {

        $count = 0;
        $maxcount = $this->fetchAllPosts(-1) - 1; //FIXME convert to db this entire transaction
        $row = $this->postRows();

        while ($count < $maxcount) {

            //Do not show non user posts
            if ($row[$count]["users_id"] != $id) {
                $count++;
                continue;
            }

            $votecap = $this->getVotecap($row[$count]["post_id"], $id);

            if ($votecap == false) {
                $downvote = $this->downvoteCreator(false);
                $upvote = $this->upvoteCreator(false);
            } else {
                if ($votecap["votecap"] == 1) {
                    $upvote = $this->upvoteCreator(true);
                    $downvote = $this->downvoteCreator(false);
                } elseif ($votecap["votecap"] == -1) {
                    $downvote = $this->downvoteCreator(true);
                    $upvote = $this->upvoteCreator(false);
                } else {
                    $downvote = $this->downvoteCreator(false);
                    $upvote = $this->upvoteCreator(false);
                }
            }

            echo '<div id="" class="py-2 mb-4">
                <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                    <div class="w-5 mx-4 flex flex-col text-center pt-2">
                        <!-- Upvote -->
                        <form action="../karma.php" method="post">
                        
                        <input type="text" name="post_upvote" value=' . $row[$count]["post_id"] . '  hidden>' . $upvote . '
                    
                        
                        <!-- Vote count -->
                        <span class="text-xs font-semibold my-1 text-gray-500"> ' . $row[$count]["post_karma"] . '</span>
                        <!-- Downvote -->
                        
                        <input type="text" name="post_downvote" value=' . $row[$count]["post_id"] . '  hidden >' . $downvote . '
                        
                        </form>
                    </div>
                    <!-- Post Information -->
                    <div class="w-11/12 pt-2" onclick="javascript:window.location.href=\'../public/page.php?p=' . $row[$count]["post_id"] . '\'">
                    
                        <div class="flex items-center text-xs mb-2">
                            <span class="text-gray-500">Posted by</span>
                            <a href="../public/Profile.php' . $row[$count]["username"] . '" class="text-gray-500 mx-1 no-underline hover:underline">ku/' . $row[$count]["username"] . '</a>
                            <span class="text-gray-500">' .$row[$count]["date"]. '</span>
                        </div>
                        <!-- Post Title -->
                        <div>
                            <h2 class="text-lg font-bold mb-1 text-gray-400 break-all">
                            ' . $row[$count]["post_title"] . '
                            </h2>
                        </div>
                        <!-- Post Description -->
                        <p class="text-gray-500 break-all">
                            ' . $row[$count]["post_content"] . '

                        </p>
                        <!-- Comments -->
                        <div class="inline-flex items-center my-1">
                            <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                                <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                                </svg>
                                <span class="ml-2 text-xs font-semibold text-gray-500">'.count($this->getCommentsCountFromPost($row[$count]["post_id"])).'</span>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>';

            $count = $count + 1;

        }
    }
    public function upvoteCount($post_id, $id)
    {
        

        $votecap = $this->getVotecap($post_id, $id);
        if ($votecap == false) {
            $upvotes = $this->upvotes($post_id);
            $upvotesNew = $upvotes[0]["post_upvote"] + 1;
            $this->upvote($upvotesNew, $post_id);
            $this->createVotecap($id, $post_id, 1);
            return;
        }
        if ($votecap["votecap"] == 1) {
            $this->deleteVotecap($id, $post_id);
            $upvotes = $this->upvotes($post_id);
            $upvotesNew = $upvotes[0]["post_upvote"] - 1;
            $this->upvote($upvotesNew, $post_id);
            return;
        }


        if ($votecap["votecap"] == -1) {
            $downvotes = $this->downvotes($post_id);
            $downvotesNew = $downvotes[0]["post_downvote"] - 1;
            $this->downvote($downvotesNew, $post_id);

            $upvotes = $this->upvotes($post_id);
            $upvotesNew = $upvotes[0]["post_upvote"] + 1;
            $this->upvote($upvotesNew, $post_id);

            $this->updateVotecapPos($post_id, $id);

        }
    }
    public function downvoteCount($post_id, $id)
    {
        

        $votecap = $this->getVotecap($post_id, $id);
        if ($votecap == false) {
            $downvotes = $this->downvotes($post_id);
            $downvotesNew = $downvotes[0]["post_downvote"] + 1;
            $this->downvote($downvotesNew, $post_id);
            $this->createVotecap($id, $post_id, -1);
            return;
        }
        if ($votecap["votecap"] == -1) {
            $this->deleteVotecap($id, $post_id);
            $downvotes = $this->downvotes($post_id);
            $downvotesNew = $downvotes[0]["post_downvote"] - 1;
            $this->downvote($downvotesNew, $post_id);
            return;
        }
        if ($votecap["votecap"] == 1) {
            $upvotes = $this->upvotes($post_id);
            $upvotesNew = $upvotes[0]["post_upvote"] - 1;

            $this->upvote($upvotesNew, $post_id);

            $downvotes = $this->downvotes($post_id);
            $downvotesNew = $downvotes[0]["post_downvote"] + 1;
            $this->downvote($downvotesNew, $post_id);

            $this->updateVotecapNeg($post_id, $id);
        }
    }
    public function updateKarma($post_id)
    {
        $upvotes = $this->upvotes($post_id);

        $downvotes = $this->downvotes($post_id);
        if ($downvotes[0]["post_downvote"] >= 0) {
            $karma = $upvotes[0]["post_upvote"] - $downvotes[0]["post_downvote"];
        }
        else
        {
            $karma = $upvotes[0]["post_upvote"] + $downvotes[0]["post_downvote"];
        }



        $this->Karma($karma,$post_id);
    }
    public function createComment($users_id,$post_id,$text)
    {
        $this->createCommmentDb($users_id, $post_id, $text);
    }
    public function fetchComment($post_id,$id)
    {        
        
        
    $postComments = $this->fetchCommentDb($post_id);
    $commentCount = count($postComments);
            for ($i = 0; $i < $commentCount; $i++) {
                // if ($postComments[$i]["users_id"] != $id) {
                //     $i++;
                //     continue;
                // }
    
                $votecap = $this->getVotecapC($postComments[$i][0], $id);
           
                if ($votecap == false) {
                    $downvote = $this->downvoteCreator(false);
                    $upvote = $this->upvoteCreator(false);
                } else {
                    if ($votecap["votecap"] == 1) {
                        $upvote = $this->upvoteCreator(true);
                        $downvote = $this->downvoteCreator(false);
                    } elseif ($votecap["votecap"] == -1) {
                        $downvote = $this->downvoteCreator(true);
                        $upvote = $this->upvoteCreator(false);
                    } else {
                        $downvote = $this->downvoteCreator(false);
                        $upvote = $this->upvoteCreator(false);
                    }
                }
            
                echo '
            <div class="flex border border-[#343536] bg-[#272729] rounded p-3">
            <div class="w-11/12 pt-2 min-w-full">
            <!-- Comment Information -->
            <div class="flex items-center text-sm mb-2">
                <img class="w-8 h-8 rounded-full mr-2" src="https://placeimg.com/192/192/people" alt="Avatar of User">
                <span class="text-gray-500">Commented by</span>
                <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">ku/' . $postComments[$i]["username"] . '•</a>
                <span class="text-gray-500">' . $postComments[$i]["date"] . '</span>
            </div>
            <!-- Comment Text -->
            <p class="text-gray-400 text-md">
            ' . $postComments[$i]["text"] . '
            </p>
            <!-- Comment Actions -->
            <div class="w-5 mx-4 flex flex-row text-center pt-2 space-x-4">
                <!-- Upvote -->
                <form action="../commentkarma.php" method="post">
                <input type="text" name="c_upvote" value=' . $postComments[$i][0] . '  hidden>' . $upvote . '
                    
                        
                <!-- Vote count -->
                <span class="text-xs font-semibold my-1 text-gray-500"> ' . $postComments[$i]["c_karma"] . '</span>
                <!-- Downvote -->
                
                <input type="text" name="c_downvote" value=' . $postComments[$i][0] . '  hidden >' . $downvote . '
                </form>
            </div>
        </div>
        </div>
            ';
            }
        }
    
    public function fetchUserComment($id)
    {
       
        
        $userComments = $this->fetchUserCommentDb($id);                    
        $commentCount = count($userComments);
        
        for ($i = 0; $i < $commentCount; $i++) {
            if ($userComments[$i]["users_id"] != $id) {
                $i++;
                continue;
            }
            $votecap = $this->getVotecapC($userComments[$i]["users_id"], $id);
            if ($votecap == false) {
                $downvote = $this->downvoteCreator(false);
                $upvote = $this->upvoteCreator(false);
            } else {
                if ($votecap["votecap"] == 1) {
                    $upvote = $this->upvoteCreator(true);
                    $downvote = $this->downvoteCreator(false);
                } elseif ($votecap["votecap"] == -1) {
                    $downvote = $this->downvoteCreator(true);
                    $upvote = $this->upvoteCreator(false);
                } else {
                    $downvote = $this->downvoteCreator(false);
                    $upvote = $this->upvoteCreator(false);
                }
            }
            echo '  
                        <div class="flex border border-[#343536] bg-[#272729] rounded p-3 ">
                            <!-- Comment Body -->
                            <div class="w-11/12 pt-2">
                                <!-- Comment Information -->
                                <div class="flex items-center text-sm mb-2">
                                    <img class="w-8 h-8 rounded-full mr-2" src="https://placeimg.com/192/192/people" alt="Avatar of User">
                                    <span class="text-gray-500">Commented by</span>
                                    <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">ku/'.$userComments[$i]["username"].' •</a>
                                    <span class="text-gray-500">'.$userComments[$i]["date"].'</span>
                                </div>
                                <!-- Comment Text -->
                                <p class="text-gray-400 text-md">
                                '.$userComments[$i]["text"].'
                                </p>
                                <!-- Comment Actions -->
                               
                                <div class="w-5 mx-4 flex flex-row text-center pt-2 space-x-4">
                                    <!-- Upvote -->
                                    <form action="../commentkarma.php" method="post">
                                    <input type="text" name="c_upvote" value=' . $userComments[$i][0] . '  hidden>' . $upvote . '
                                        
                                            
                                    <!-- Vote count -->
                                    <span class="text-xs font-semibold my-1 text-gray-500"> ' . $userComments[$i]["c_karma"] . '</span>
                                    <!-- Downvote -->
                                    
                                    <input type="text" name="c_downvote" value=' . $userComments[$i][0] . '  hidden >' . $downvote . '
                                </div>
                                </form>
                        </div>
                    </div> ';
             
        }
    }
    public function upvotesCount($c_id, $id)
    {
        

        $votecap = $this->getVotecapC($c_id, $id);
        if ($votecap == false) {
            $upvotes = $this->upvotesC($c_id);
            $upvotesNew = $upvotes[0]["c_upvote"] + 1;
            $this->cupvote($upvotesNew, $c_id);
            $this->createVotecapC($id, $c_id, 1);
            return;
        }
        if ($votecap["votecap"] == 1) {
            $this->deleteVotecapC($id, $c_id);
            $upvotes = $this->upvotesC($c_id);
            $upvotesNew = $upvotes[0]["c_upvote"] - 1;
            $this->cupvote($upvotesNew, $c_id);
            return;
        }


        if ($votecap["votecap"] == -1) {
            $downvotes = $this->downvotesC($c_id);
            $downvotesNew = $downvotes[0]["c_downvote"] - 1;
            $this->downvotesC($downvotesNew);

            $upvotes = $this->upvotesC($c_id);
            $upvotesNew = $upvotes[0]["c_upvote"] + 1;
            $this->cupvote($upvotesNew,$c_id);

            $this->cupdateVotecapPos($c_id, $id);

        }
    }
    public function downvotesCount($c_id, $id)
    {
        

        $votecap = $this->getVotecapC($c_id, $id);
        
        
        if ($votecap == false) {
            $downvotes = $this->downvotesC($c_id);
            $downvotesNew = $downvotes[0]["c_downvote"] + 1;
            $this->cdownvote($downvotesNew, $c_id);
            $this->createVotecapC($id, $c_id, -1);
            return;
        }
        if ($votecap["votecap"] == -1) {
            $this->deleteVotecapC($id, $c_id);
            $downvotes = $this->downvotesC($c_id);
            $downvotesNew = $downvotes[0]["c_downvote"] - 1;
            $this->cdownvote($downvotesNew, $c_id);
            return;
        }
        if ($votecap["votecap"] == 1) {
            $upvotes = $this->upvotesC($c_id);
            $upvotesNew = $upvotes[0]["c_upvote"] - 1;

            $this->cupvote($upvotesNew, $c_id);

            $downvotes = $this->downvotesC($c_id);
            $downvotesNew = $downvotes[0]["c_downvote"] + 1;
            $this->cdownvote($downvotesNew, $c_id);

            $this->cupdateVotecapNeg($c_id, $id);
        }
    }
    public function updatesKarma($c_id)
    {
        $upvotes = $this->upvotesC($c_id);

        $downvotes = $this->downvotesC($c_id);
        if ($downvotes[0]["c_downvote"] >= 0) {
            $karma = $upvotes[0]["c_upvote"] - $downvotes[0]["c_downvote"];
        }
        else
        {
            $karma = $upvotes[0]["c_upvote"] + $downvotes[0]["c_downvote"];
        }



        $this->KarmaC($karma,$c_id);
    }
    public function getPostIdFromCommentId($c_id)
    {
        return $this->getsPostIdFromCommentId($c_id);
        
    }
    
}
          

?>
