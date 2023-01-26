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
    public function createPostFe($id)
    {

        $count = 0;
        $post_id = $this->getPostId($id);
        $postInfo = $this->getUserInfo($id);
        $userInfo = $this->getUser($id);
        while ($count < $post_id - 1) {

            echo '<div id="" class="py-2 mb-4">
            <div class="flex border border-[#343536] bg-[#272729] transition duration-500 ease-in-out hover:border-red-500 rounded cursor-pointer">
                <div class="w-5 mx-4 flex flex-col text-center pt-2">
                    <!-- Upvote -->
                    <form action="" method="post">
                        <button type="submit" name="post_upvote" class="text-xs">
                            <input type="text" hidden disabled>
                            <svg class="w-5 fill-current text-gray-500 transition duration-500 hover:text-[#ff4057]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"></path>
                            </svg>
                        </button>
                        <!-- Vote count -->
                        <span class="text-xs font-semibold my-1 text-gray-500">20k</span>
                        <!-- Downvote -->
                        <button type="submit" name="post_upvote" class="text-xs">
                            <input type="text" hidden disabled>
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
                        <a href="#" class="text-gray-500 mx-1 no-underline hover:underline">ku/' . $userInfo[0]["username"] . '</a>
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
        
                    </div>
        
                    <div class="inline-flex items-center my-1">
                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-gray-500 fill-current" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                            <span class="ml-2 text-xs font-semibold text-gray-500">Edit</span>
                        </div>
                        <div class="flex transition duration-500 hover:bg-gray-700 p-1 ml-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-gray-500 fill-current" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="ml-2 text-xs font-semibold text-gray-500">Delete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            $count = $count + 1;
        }
    }
}
