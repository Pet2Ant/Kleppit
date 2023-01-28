<?php

class IndexPostInfo extends PostInfo
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
    
    public function getAllPosts($sortTo,$userId)
    {
        
        $count = 0;
        $maxcount = $this->fetchAllPosts(-1) - 1;
        if($sortTo == "Default"){
            $row=$this->postRows();
          }
          elseif($sortTo == "by Karma"){
            
            $row=$this->postRowsKarmaDesc();
          }
          elseif($sortTo == "Newest"){
           
            $row=$this->postRowsSortNewest();
          }
          elseif($sortTo == "Oldest"){
           
            $row=$this->postRowsSortOldest();
          }

        while ($count < $maxcount) {
            $votecap = $this->getVotecap($row[$count]["post_id"], $userId);
            
            if ($votecap == false) 
            {
                $downvote = $this->downvoteCreator(false);
                $upvote = $this->upvoteCreator(false);
            }
            else{
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
            <div class="w-11/12 pt-2 " onclick="javascript:window.location.href=\'../public/page.php?p=' . $row[$count]["post_id"] . '\'">
            
                <div class="flex items-center text-xs mb-2">
                    <span class="text-gray-500">Posted by</span>
                    <a href="../public/Profile.php?u=' . $row[$count]["username"] . '" class="text-gray-500 mx-1 no-underline hover:underline">ku/' . $row[$count]["username"] . '</a>
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
                        <span class="ml-2 text-xs font-semibold text-gray-500">Comments</span>
                    </div>                    
                </div>
            </div>
        </div>
    </div>';
                $count = $count + 1;
            }
        }
    }


    
?>