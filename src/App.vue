<script setup>
import { RouterView } from "vue-router";
import store from "./store";
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";
import { useToast } from "primevue/usetoast";
const toast = useToast();

const firebaseConfig = {
  apiKey: "AIzaSyCclvYkIyqFjd1clopFV__EuZBZSiHOvh4",
  authDomain: "orminlivestock.firebaseapp.com",
  projectId: "orminlivestock",
  storageBucket: "orminlivestock.appspot.com",
  messagingSenderId: "326973138309",
  appId: "1:326973138309:web:670af5d1c9d7af0f1710ec",
  measurementId: "G-WXM2BQ2PZD"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

const messaging = getMessaging(app);
onMessage(messaging, (payload) => {
    console.log("Message received. ", payload);
    toast.add({ severity: 'info', summary:  payload.data.title, detail:  payload.data.body, life: 3000 });
});

getToken(messaging, {
    vapidKey:
        "BCaUVDpggDOFOi-MaiakdS4F8y-uK1VYfw88yqGjhrpz97GhHngdZN06KCS3C3q5hWGVccMolhASK78n7srVYhI"
})
    .then((currentToken) => {
        if (currentToken) {
            // Send the token to your server and update the UI if necessary
            // ...
            store.dispatch('updatePushToken', currentToken);
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
        <Toast/>
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
