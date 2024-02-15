// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyCclvYkIyqFjd1clopFV__EuZBZSiHOvh4",
    authDomain: "orminlivestock.firebaseapp.com",
    projectId: "orminlivestock",
    storageBucket: "orminlivestock.appspot.com",
    messagingSenderId: "326973138309",
    appId: "1:326973138309:web:670af5d1c9d7af0f1710ec",
    measurementId: "G-WXM2BQ2PZD"
  });

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log(
      '[firebase-messaging-sw.js] Received background message ',
      payload
    );
    // Customize notification here
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
      body: payload.notification.body,
      icon: '/livestocklogo.ico'
    };
  
    self.registration.showNotification(notificationTitle, notificationOptions);
  });