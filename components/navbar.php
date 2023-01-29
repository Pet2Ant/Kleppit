<?php

include 'searchbar.php';

class Navbar {

    private function userImage() {

        if (isset($_SESSION["id"])) {

            return '<img class="w-8 h-8 mr-2 rounded-full" src="../assets/tacejm6avjx41.jpg" alt="user photo" />';

        } else {

            return '<div class="hidden"></div>';

        }

    }

    private function userDropdown() {
        if (isset($_SESSION["id"])) {
            return '
                <p class="hidden lg:block">'. $_SESSION["username"] .'</p>
                <svg class="w-4 h-4 mx-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                </button>
                </span>

                <!-- User Dropdown menu -->
                <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                <div class="absolute right-0 w-56 mt-2 origin-top-right bg-[#1a1a1b] border border-[#343536] divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                    <div class="px-4 py-3">
                        <p class="text-sm leading-5 text-red-500">Signed in as</p>
                        <p class="text-md font-semibold leading-5 text-red-600 truncate">'. $_SESSION["email"] .'</p>
                        <p class="text-sm leading-5 text-red-600 truncate py-1">
                            1234 Upvotes
                        </p>
                    </div>
                    <div class="py-1">
                        <a href="./Profile.php" tabindex="0" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Profile</a>
                        <a href="./ContactUs.php" tabindex="1" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Contact Us</a>
                    </div>
                    <div class="py-1">
                        <a href="./userAgreement.php" tabindex="2" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">User Agreement</a>


                        <a href="./privacyPolicy.php" tabindex="2" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Privacy Policy</a>
                    </div>
                    <div class="py-1">
                        <a href="..\login\logout.php" tabindex="4" class="text-gray-400 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-gray-500" role="menuitem">Sign out</a>
                    </div>
                <div>
            ';
    
        } else {
            return '
                <a href="./signupform.php" tabindex="4" class="text-red-500 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-red-600" role="menuitem">Signup</a>

                <a href="./loginform.php" tabindex="4" class="text-red-500 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left transition duration-500 ease-in-out hover:text-red-600" role="menuitem">Log in</a>
            ';
        }   

    }

    public function genereElement() {

        $searchbar = new Searchbar();

        echo '
            <header id="header" class="fixed inset-0 z-50 flex h-14 bg-[#1a1a1b] select-none">
                <div class="flex flex-1 items-center space-x-4 border-b border-[#343536] px-5">
                    <!-- Icon + Post button + Search bar -->
                    <div class="flex flex-1 items-center space-x-4">
                        <!-- Large logo -->
                        <a id="largeLogo" href="./index.php"><img src="..//assets/kleppit-high-resolution-logo-color-on-transparent-background.png" class="hidden lg:inline-block h-10 transition duration-500 ease-in-out hover:opacity-75" alt="logo" />
                        </a>
                        <!-- Small Logo -->
                        <a id="smallLogo" href="./index.php"><img src="..//assets/kleppit-website-favicon-color.png" class="lg:hidden h-12 w-14 transition duration-500 ease-in-out hover:opacity-75 mr-10" alt="small logo" />
                        </a>
                        '. $searchbar->genereElement() .'
                    </div>
                    <!-- User button -->
                    <div class="space-x-4 py-6 flex flex-col justify-center ">
                      <div class="flex items-center justify-center">
                        <div class="relative inline-block text-left dropdown">
                          <span class="rounded-md shadow-sm">
                            <button class="flex items-center w-full text-sm font-medium leading-5 text-red-500 transition duration-150 ease-in-out hover:text-red-600" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                              <!-- if user is not logged in do not display the user photo -->
                              '. $this->userImage() .'
                              '. $this->userDropdown() .'
                              </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </header>

                        
        ';

    }

}