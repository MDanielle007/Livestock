<template>
    <v-app>
        <v-main>
            <router-view />
        </v-main>
    </v-app>
</template>

<script setup>
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
  apiKey: "AIzaSyCclvYkIyqFjd1clopFV__EuZBZSiHOvh4",
  authDomain: "orminlivestock.firebaseapp.com",
  projectId: "orminlivestock",
  storageBucket: "orminlivestock.appspot.com",
  messagingSenderId: "326973138309",
  appId: "1:326973138309:web:670af5d1c9d7af0f1710ec",
  measurementId: "G-WXM2BQ2PZD"
};

const app = initializeApp(firebaseConfig);

const messaging = getMessaging();
onMessage(messaging, (payload) => {
    console.log("Message received. ", payload);
    // ...
});

getToken(messaging, {
    vapidKey:
        "BCaUVDpggDOFOi-MaiakdS4F8y-uK1VYfw88yqGjhrpz97GhHngdZN06KCS3C3q5hWGVccMolhASK78n7srVYhI",
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
