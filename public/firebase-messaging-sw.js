// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyADzOkclsSx1KfgytmThIeLnmB6etrc_DY",
    authDomain: "push-notifications-70d4b.firebaseapp.com",
    projectId: "push-notifications-70d4b",
    storageBucket: "push-notifications-70d4b.appspot.com",
    messagingSenderId: "102839673618",
    appId: "1:102839673618:web:b305b0b3a2f661f73c09cb",
    measurementId: "G-JGWG25LJCZ",
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