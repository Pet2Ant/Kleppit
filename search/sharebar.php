<?php

class Searchbar {
    
    public function generateSearchbar() {
        echo '
        <div class="mx-4 flex flex-1 items-center space-x-3 rounded border border-[#343536] bg-[#272729] px-4 py-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-[#878A8C]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input class="flex-1 bg-transparent text-sm focus:outline-none text-gray-400" type="text" placeholder="Search Kleppit OWO OWO" />
        </div>';
    }

}

