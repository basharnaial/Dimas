import './bootstrap';
import { createApp } from 'vue';
import router from './router';
import MainLayout from './components/MainLayout.vue';

const app = createApp(MainLayout);
app.use(router);
app.mount('#app');
