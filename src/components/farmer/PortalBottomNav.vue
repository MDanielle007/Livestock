<template>

<div class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-white border border-gray-200 rounded-full bottom-4 left-1/2 dark:bg-gray-700 dark:border-gray-600">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto">
        <router-link :to="{name:'FarmerHome'}" data-tooltip-target="tooltip-home" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-l-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-10 h-10 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.27446 10.1262C5 10.7229 5 11.4018 5 12.7595V16.9999C5 18.8856 5 19.8284 5.58579 20.4142C6.11733 20.9457 6.94285 20.9949 8.5 20.9995V16C8.5 14.8954 9.39543 14 10.5 14H13.5C14.6046 14 15.5 14.8954 15.5 16V20.9995C17.0572 20.9949 17.8827 20.9457 18.4142 20.4142C19 19.8284 19 18.8856 19 16.9999V12.7595C19 11.4018 19 10.7229 18.7255 10.1262C18.4511 9.52943 17.9356 9.08763 16.9047 8.20401L15.9047 7.34687C14.0414 5.74974 13.1098 4.95117 12 4.95117C10.8902 4.95117 9.95857 5.74974 8.09525 7.34687L7.09525 8.20401C6.06437 9.08763 5.54892 9.52943 5.27446 10.1262ZM13.5 20.9999V16H10.5V20.9999H13.5Z"/>
            </svg>
            <span class="sr-only">Home</span>
        </router-link>
        <div id="tooltip-home" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Home
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <router-link :to="{name:'FarmerLivestocks'}" data-tooltip-target="tooltip-wallet" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-10 h-10 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.4037 20.8018C14.0282 19.9702 20 16.5681 20 11.5C20 7 16.2667 4 12 4C7.87627 4 4 7 4 11.5C4 16.5681 9.97178 19.9702 11.5963 20.8018C11.8532 20.9334 12.1468 20.9334 12.4037 20.8018ZM11.7687 14.7565L8.97014 11.8107C8.3998 11.2103 8.31058 10.2991 8.75365 9.5995C9.49154 8.43441 11.2101 8.4922 11.868 9.70422L11.9376 9.83247C11.9645 9.88195 12.0355 9.88195 12.0624 9.83247L12.132 9.70422C12.7899 8.4922 14.5085 8.43441 15.2463 9.5995C15.6894 10.2991 15.6002 11.2103 15.0299 11.8107L12.2313 14.7565C12.1386 14.8541 12.0922 14.9029 12.0359 14.9142C12.0122 14.919 11.9878 14.919 11.9641 14.9142C11.9078 14.9029 11.8614 14.8541 11.7687 14.7565Z"/>
            </svg>

            <span class="sr-only">Livestock</span>
        </router-link>
        <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Livestock
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <router-link :to="{name:'FarmerSales'}" data-tooltip-target="tooltip-settings" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-10 h-10 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4H5.62563C6.193 4 6.47669 4 6.70214 4.12433C6.79511 4.17561 6.87933 4.24136 6.95162 4.31912C7.12692 4.50769 7.19573 4.7829 7.33333 5.33333L7.51493 6.05972C7.616 6.46402 7.66654 6.66617 7.74455 6.83576C8.01534 7.42449 8.5546 7.84553 9.19144 7.96546C9.37488 8 9.58326 8 10 8V8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M18 17H7.55091C7.40471 17 7.33162 17 7.27616 16.9938C6.68857 16.928 6.28605 16.3695 6.40945 15.7913C6.42109 15.7367 6.44421 15.6674 6.49044 15.5287V15.5287C6.54177 15.3747 6.56743 15.2977 6.59579 15.2298C6.88607 14.5342 7.54277 14.0608 8.29448 14.0054C8.3679 14 8.44906 14 8.61137 14H14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.5279 14H10.9743C9.75838 14 9.15042 14 8.68147 13.7246C8.48343 13.6083 8.30689 13.4588 8.15961 13.2825C7.81087 12.8652 7.71092 12.2655 7.51103 11.0662C7.30849 9.85093 7.20722 9.2433 7.44763 8.79324C7.54799 8.60536 7.68722 8.44101 7.85604 8.31113C8.26045 8 8.87646 8 10.1085 8H16.7639C18.2143 8 18.9395 8 19.2326 8.47427C19.5257 8.94854 19.2014 9.59717 18.5528 10.8944L18.1056 11.7889C17.5677 12.8647 17.2987 13.4026 16.8154 13.7013C16.3321 14 15.7307 14 14.5279 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <circle cx="17" cy="20" r="1" fill="currentColor"/>
                <circle cx="9" cy="20" r="1" fill="currentColor"/>
            </svg>

            <span class="sr-only">Settings</span>
        </router-link>
        <div id="tooltip-settings" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Settings
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <router-link :to="{name:'FarmerDataHistory'}" data-tooltip-target="tooltip-profile" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-r-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-10 h-10 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M13.5,8H12V13L16.28,15.54L17,14.33L13.5,12.25V8M13,3A9,9 0 0,0 4,12H1L4.96,16.03L9,12H6A7,7 0 0,1 13,5A7,7 0 0,1 20,12A7,7 0 0,1 13,19C11.07,19 9.32,18.21 8.06,16.94L6.64,18.36C8.27,20 10.5,21 13,21A9,9 0 0,0 22,12A9,9 0 0,0 13,3" stroke="none" />
            </svg>
            <span class="sr-only">Profile</span>
        </router-link>
        <div id="tooltip-profile" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Profile
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    
}
</script>
<style>
    
</style>