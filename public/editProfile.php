<?php session_start();
include "../databasecon/dbcon.php";
include "../profile/profileinfo.php";
include "../profile/profilecontr.php";
include "../profile/profileview.php";
include '../components/navbar.php';
$profileInfo = new ProfileInfoView();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kleppit</title>
    <link rel="icon" href="../assets/kleppit-website-favicon-color.png" />
    <link rel="stylesheet" href="./css/style.css">
</head>

<body id="page" class="scroll-smooth bg-zinc-900 md:scrollbar-default ">
    <!-- Loader -->
    <div id="loader" class="loader fixed top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-red-500"></div>
    </div>
    <!-- Nav Bar -->
    <?php
    $navbar = new Navbar();
    $navbar->genereElement();
    ?>

    <!-- Main content -->
    <div id="main" class=" py-12 mt-12 relative">
        <div id="container" class=" container mx-auto">
            <h2 class="block uppercase text-3xl font-bold text-red-500">Profile Settings</h2>
            <hr class="mt-6 border-t border-gray-400 pt-4 w-full">
            <div class="pt-2">
                <div class="container mx-auto">
                    <div class="w-full max-w-2xl p-6 mx-auto">
                        <!--Change avatar-->
                        <form enctype="multipart/form-data" action="../pfp.php" method="post">
                            <div class="w-full pt-4">
                                <h2 class="text-2xl font-bold text-red-500">Personal Info</h2>
                                <hr class="mt-6 border-t border-gray-400 pt-4 w-full">
                                <div class='w-full md:w-full px-3 mb-6'>
                                    <label class='block uppercase tracking-wide text-red-500 text-xs font-bold mb-2'>
                                        Change avatar
                                    </label>
                                    <div class="flex justify-center avatar">
                                        <div class="w-48  space-y-4">
                                            <input id="inputAvatar" type="file" name="userfile" class="invisible">
                                            <button id="avatarChanger" class="hover:opacity-75">
                                                <img id="avatarImg" class="w-48 h-48 mr-2 rounded-full border-2 border-red-500" src="../avatars/<?php echo $profileInfo->fetchAvatar($_SESSION["id"])[0]['profile_pic'] ?>" alt="user photo" />
                                            </button>
                                            <button type="submit" name="submit" class="w-full text-md font-bold bg-red-500 transition duration-500 ease-in-out hover:bg-red-600 rounded-md p-1">
                                                Change avatar
                                            </button>
                                            <script>
                                                // We want to prevent form submission, but still allow the user to upload a file
                                                document.getElementById('avatarChanger').addEventListener('click', function(e) {
                                                    e.preventDefault();
                                                    document.getElementById('inputAvatar').click();
                                                    //Update the image preview
                                                    document.getElementById('inputAvatar').addEventListener('change', function() {
                                                        if (this.files && this.files[0]) {

                                                            //Check if the file is too big (2MB)
                                                            if (this.files[0].size > 2090000) {
                                                                alert("File is too big! (Max 2MB, current: " + this.files[0].size / 1000000 + "MB)");
                                                                //Refresh the page
                                                                window.location.reload();
                                                                return;
                                                            };

                                                            //Check if the file is an image
                                                            if (this.files[0].type != "image/jpeg" && this.files[0].type != "image/png" && this.files[0].type != "image/gif" && this.files[0].type != "image/jpg") {
                                                                alert("File is not an image!");
                                                                //Refresh the page
                                                                window.location.reload();
                                                                return;
                                                            };

                                                            var img = document.getElementById('avatarImg');
                                                            img.src = URL.createObjectURL(this.files[0]);
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-t border-gray-700 pt-4 w-1/2 mx-auto mt-8 mb-4">
                                <div class='w-full md:w-full px-3 mb-6'>
                                    <label class="block uppercase tracking-wide text-red-500 text-xs font-bold mb-2">Profile
                                        Title
                                    </label>
                                    </form>
                                <form action="../profile.php" method="post">
                                        <textarea placeholder="Display name" type="text" name="name" class="text-sm block px-3 py-2 rounded-lg w-full bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-800 focus:border-zinc-600 text-red-600 focus:outline-none "></textarea>
                                    </div>
                                    <div class='w-full md:w-full px-3 mb-6'>
                                        <label class='block uppercase tracking-wide text-red-500 text-xs font-bold mb-2'>
                                            Description
                                        </label>
                                        <textarea id="textArea" placeholder="Write something about yourself!" type="text" name="description" class="resize-y text-sm block px-3 py-2 rounded-lg w-full placeholder-text-lg bg-zinc-800 border-2 border-zinc-700 placeholder-zinc-600 shadow-md focus:placeholder-zinc-500 focus:bg-zinc-900 focus:border-zinc-600 text-red-600 focus:outline-none"></textarea>
                                    </div>
                                    <button type="submit" name="submit" class="w-full text-md font-bold bg-red-500 transition duration-500 ease-in-out hover:bg-red-600 rounded-md p-1">
                                        Save Changes
                                    </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="./main.js"></script>

</html>