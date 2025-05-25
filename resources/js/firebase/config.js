// resources/js/firebase/config.js
import { initializeApp } from 'firebase/app';
import { getAuth } from 'firebase/auth';
import { getFirestore } from 'firebase/firestore';

const firebaseConfig = {
  apiKey: "AIzaSyB8AgWmuJvPO-UcWf6-LXiV2mZHzq7Hg5c", // Ganti ini kalau sudah kamu generate baru
  authDomain: "testdb-apps.firebaseapp.com",
  projectId: "testdb-apps",
  storageBucket: "testdb-apps.appspot.com",
  messagingSenderId: "826407458596",
  appId: "1:826407458596:web:fc7f986cf4a797adb145b1"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

export { auth, db };
