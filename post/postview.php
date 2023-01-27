<?php

class PostInfoView extends PostInfo
{
    public function fetchTitle($id)
    {
        $postInfo = $this->getPostInfo($id);
        echo $postInfo[0]["post_title"];
    }
    public function fetchContent($id)
    {
        $postInfo = $this->getPostInfo($id);
        echo $postInfo[0]["post_content"];
    }
    public function createPostFe($id)
    {
       
        $count = 0;
        $post_id = $this->getPostId($id);
        $postInfo = $this->getPostInfo($id);
        $userInfo = $this->getUser($id);
        while($count<$post_id-1){
           
            echo '<div id="" class="py-2 mb-4">
        <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
            <div class="w-5 mx-4 flex flex-col text-center pt-2">
                <!-- Upvote -->
                <form action="../karma.php" method="post">
                
                <input type="text" name="post_upvote" value='.$count.' hidden>
                <button type="submit" name="upvote" class="text-xs">
                    <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                    </svg>
                </button>
                
                <!-- Vote count -->
                <span class="text-xs font-semibold my-1 text-gray-500">'.$postInfo[$count]["post_karma"].'</span>
                <!-- Downvote -->
                
                <input type="text" name="post_downvote" value='.$count.' hidden >
                <button type="submit" name="downvote" class="text-xs">
                    <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M7 10V2h6v8h5l-8 8-8-8h5z"></path>
                    </svg>
                </button>
                </form>
            </div>
            <!-- Post Information -->
            <div class="w-11/12 pt-2">
                <div class="flex items-center text-xs mb-2">
                    <span class="text-gray-500">Posted by</span>
                    <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">ku/'.$userInfo[0]["username"].'</a>
                    <span class="text-gray-500">2 hours ago</span>
                </div>
                <!-- Post Title -->
                <div>
                    <h2 class="text-lg font-bold mb-1 text-gray-400">
                    ' . $postInfo[$count]["post_title"] . '
                    </h2>
                </div>
                <!-- Post Description -->
                <p class="text-gray-500">
                    ' . $postInfo[$count]["post_content"] . '

                </p>
                <!-- Comments -->
                <div class="inline-flex items-center my-1">
                    <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                        <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"></path>
                        </svg>
                        <span class="ml-2 text-xs font-semibold text-gray-500">3k Comments</span>
                    </div>
                    <!-- Share -->
                    <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                        <svg class="w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z"></path>
                        </svg>
                        <span class="ml-2 text-xs font-semibold text-gray-500">Share</span>
                    </div>
                </div>
            </div>
        </div>
    </div>';
            $count = $count + 1;
           

           
        }

    }

    public function createVoteCap($postC,$id)
    {

    }
    
    public function upvoteCount($postC,$id)
    {
   
        
        $post_id = $postC + 1;
        
        $votecap = $this->getVotecap($post_id, $id);
        echo $votecap[0]["votecap"];
        if($votecap[0]["votecap"] == -1 )
        {
            $downvotes = $this->downvotes($post_id);
            
           
            $downvotesNew = $downvotes[0]["post_downvote"] - 1;
            $this->downvote($downvotesNew, $post_id, $id);
            $upvotes = $this->upvotes($post_id);
            
            $upvotesNew = $upvotes[0]["post_upvote"] + 1;
            $this->updateVotecapPos($post_id, $id);
           
            $this->upvote($upvotesNew, $post_id, $id);
         
        }
        
        if ($votecap[0]["votecap"] != 1 && $votecap[0]["votecap"] != -1) {
            
            $upvotes = $this->upvotes($post_id);
            
            $upvotesNew = $upvotes[0]["post_upvote"] + 1;
            $this->updateVotecapPos($post_id, $id);
           
            $this->upvote($upvotesNew, $post_id, $id);
           
        }
        

    }
    public function downvoteCount($postC,$id)
    {
        $post_id = $postC + 1;
        
        $votecap = $this->getVotecap($post_id, $id);
        echo $post_id."<br>". $id;
        echo $votecap[0]["votecap"];
        if($votecap[0]["votecap"] == 1)
        {
            $upvotes = $this->upvotes($post_id);
            $upvotesNew = $upvotes[0]["post_upvote"] - 1;
            $this->upvote($upvotesNew, $post_id, $id);
            $downvotes = $this->downvotes($post_id);
            $this->updateVotecapNeg($post_id, $id);
            $downvotesNew = $downvotes[0]["post_downvote"] + 1;
            $this->downvote($downvotesNew, $post_id, $id);
        }
        if ($votecap[0]["votecap"] != 1 && $votecap[0]["votecap"] != -1) {
            $downvotes = $this->downvotes($post_id);
            $this->updateVotecapNeg($post_id, $id);
            $downvotesNew = $downvotes[0]["post_downvote"] + 1;
            $this->downvote($downvotesNew, $post_id, $id);
        }
    }
    public function updateKarma($postC)
    {   

        $post_id = $postC + 1;
        
        $upvotes = $this->upvotes($post_id);
        
        $downvotes = $this->downvotes($post_id);
        
        $karma = $upvotes[0]["post_upvote"] - $downvotes[0]["post_downvote"];
       
        $this->Karma($karma,$post_id);

        
    }
    //votecap DB needs to give the ability to every user to upvote/downvote depending 
    // on the post 
    // so thelei set up swsto 
    // tipou kathe fora pou ginete post create gia olous tous user sto DB to votecap

 }
        


    

?>