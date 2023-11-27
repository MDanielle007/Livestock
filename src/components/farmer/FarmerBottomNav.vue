<template>
    <CurvedBottomNavigation
        :options="options" v-model="selected"
        foreground-color='#42A5F5'
        badge-color='#FBC02D'
        background-color='#FFFFFF'
        icon-color='#0000008A'
        style="
            font-size:x-large;"
        />
</template>

<script>
import { defineComponent } from 'vue';


export default defineComponent({
    data: () => ({
        selected: 1,
        options: [
            { 
                id: 1, 
                icon: 'fa-solid fa-house', 
                title: 'Home',
                path: {name:'Farmer Dashboard'}
            },
            { 
                id: 2, 
                icon: 'fa-solid fa-cow', 
                title: 'Livestock',
                path: {name:'Farmer Livestocks'}
            },
            { 
                id: 3, 
                icon: 'fa-solid fa-clock-rotate-left', 
                title: 'History',
                path: {name:'History'} 
            },
            { 
                id: 4, 
                icon: 'fa-solid fa-bell', 
                title: 'Notifications',
                path: {name:'Notifications'} 
            },
            { 
                id: 5, 
                icon: 'fa-solid fa-user', 
                title: 'Profile' ,
                path: {name:'Farmer Profile'} 
            }
        ]
    }),
});
</script>