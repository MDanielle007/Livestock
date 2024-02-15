<script setup>
import { RouterView } from "vue-router";

import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
    apiKey: "AIzaSyADzOkclsSx1KfgytmThIeLnmB6etrc_DY",
    authDomain: "push-notifications-70d4b.firebaseapp.com",
    projectId: "push-notifications-70d4b",
    storageBucket: "push-notifications-70d4b.appspot.com",
    messagingSenderId: "102839673618",
    appId: "1:102839673618:web:b305b0b3a2f661f73c09cb",
    measurementId: "G-JGWG25LJCZ",
};

const app = initializeApp(firebaseConfig);

const messaging = getMessaging();
onMessage(messaging, (payload) => {
    console.log("Message received. ", payload);
    // ...
});

getToken(messaging, {
    vapidKey:
        "BJGt4icVmRwHKQnntn44gFVA3acmEJ8XP7URcwBsbSbqgw-0OSmgZ8ZyhLq0gTFxfmPZzUhlf6z9L5nAt7oUbXs",
    //  BJGt4icVmRwHKQnntn44gFVA3acmEJ8XP7URcwBsbSbqgw-0OSmgZ8ZyhLq0gTFxfmPZzUhlf6z9L5nAt7oUbXs

})
    .then((currentToken) => {
        if (currentToken) {
            // Send the token to your server and update the UI if necessary
            // ...
            console.log("Token is:" + currentToken);
        } else {
            // Show permission request UI
            console.log(
                "No registration token available. Request permission to generate one."
            );
            // ...
        }
    })
    .catch((err) => {
        console.log("An error occurred while retrieving token. ", err);
        // ...
    });
</script>

<template>
    <div>
        <RouterView />
    </div>
</template>

<style>
body {
    margin: 0;
    padding: 0;
    position: relative;
}
</style>
