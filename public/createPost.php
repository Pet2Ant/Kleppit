<?php
include '../components/navbar.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kleppit</title>
    <link rel="icon" href="../assets/kleppit-website-favicon-color.png" />
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="bg-zinc-900 ">
    <!-- Loader -->
    <div id="loader" class="loader fixed top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-red-500"></div>
     </div>
    <!-- Nav Bar -->
    <?php
        $navbar = new Navbar();
        $navbar->genereElement();
    ?>

    
      <div class="py-36 mt-12">
        <div class="flex flex-row justify-center">
            <div class="flex flex-row ">
                <!-- Post Body -->
                <div class="flex-1 border border-[#878A8C] bg-zinc-800 rounded-md max-w-lg max-h-lg mx-auto px-14 ">
                    <img src="../assets/kleppit-high-resolution-logo-color-on-transparent-background.png" alt="logo"
                        class="py-6 w-1/2 mx-auto"/>
                        <div class="w-full">
                            <div class="mt-6">
                                <div class="text-center font-semibold text-2xl text-red-500">
                                    What's on your mind?
                                </div>
                                <!-- 2 buttons to choose from, text and image-->
                                <div class="mt-6">
                                    <div class="flex justify-center">
                                        <div class="flex">
                                            <span class="inline-flex rounded-md shadow-sm">
                                                <button onclick="changeButton()" type="button" id="textButton"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-red-600 transition duration-300 ease-in-out">
                                                    Text
                                                </button>
                                            </span>
                                            <span class="ml-3 inline-flex rounded-md shadow-sm">
                                                <button onclick="changeButton()" type="button" id="imageButton"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-red-500 bg-zinc-800 hover:text-red-600 focus:outline-none focus:border-[#ff4957] focus:shadow-outline-[#ff4957] active:bg-red-600 transition duration-300 ease-in-out hover:bg-red-600 hover:text-white">
                                                    Image
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>






                                <form action="../post.php" method="post" class="mt-8">
                                    <div class="mx-auto max-w-lg">
                                        <div class="py-1">
                                            <span class="px-1 text-md text-red-500">Title</span>
                                            <input placeholder="Title..." type="text" name="title"
                                                class="text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-600 focus:outline-none" />
                                        </div>
                                        <div class="py-1">
                                            <span class="px-1 text-md text-red-500">Content</span>
                                            <!-- Text Area -->
                                            <textarea id="textArea" name="content" placeholder="Share your thoughts" type="text"
                                                class="resize-y text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-600 focus:outline-none"></textarea>
                                            <!-- Image Area -->
                                            <div class="flex items-center justify-center w-full hidden"
                                                id="imageUpload">
                                                <label for="dropzone-file"
                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-zinc-700 hover:bg-zinc-600">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                            </path>
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                                class="font-semibold">Click to upload</span> or drag and
                                                            drop</p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG,
                                                            JPG or GIF (MAX. 800x400px)</p>
                                                    </div>
                                                    <input id="dropzone-file" type="file" class="hidden" />
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="py-2">
                                        <button type="submit" name="submit"
                                            class="mt-3 w-full bg-red-600 text-white active:bg-red-600 text-sm font-semibold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition duration-150 ease-in-out hover:bg-red-700">
                                            Create Post
                                        </button>
                                    </div>
                                </form>

































                            </div>
                        </div>
                </div>
                <!-- Rules Sidebar -->
                <div class="flex-1 max-w-sm pl-9  hidden lg:block ">
                    <div class="py-2">
                        <div class="flex justify-center ">
                            <div class="w-80 pb-2 border bg-zinc-900 border-gray-500 rounded-lg ">
                                <div
                                    class="p-3 bg-[url('../assets/kleppit-high-resolution-logo-white-on-black-background-cropped.png')] bg-contain rounded-lg object-cover h-16">
                                    <div class="mt-12 pt-1">
                                        <hr class="w-full border-1 border-slate-700" />
                                    </div>
                                </div>

                                <div class="flex flex-col items-center px-2">

                                    <div class="underline text-center font-semibold text-xl text-red-500">
                                        Rules
                                    </div>
                                    <div class="underline underline-offset-4 mt-3 text-red-500">
                                        <div class="text-center font-semibold py-1 text-sm">
                                            1. No NSFW Content
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            2. No Spam
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            3. No Racism
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            4. No Illegal Activity
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            5. No Harassment
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            6. No Advertising
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            7. No Impersonation
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            8. No Trolling
                                        </div>
                                        <div class="text-center font-semibold py-1 text-sm">
                                            9. No Self Promotion
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="./main.js"></script>
</body>

</html>