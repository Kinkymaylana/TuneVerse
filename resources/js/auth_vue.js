import { createApp } from 'vue';
import AppAuth from './AppAuth.vue';
import router from './router'; // Import router khusus autentikasi

const app = createApp(AppAuth);
app.use(router);
app.mount('#auth-app'); // Mount ke elemen dengan id 'auth-app' di auth_vue.blade.php
