import './bootstrap';
import { createApp } from 'vue';
import router from './router';
import MainLayout from './components/MainLayout.vue';
import i18n from './i18n/index.js';

const app = createApp(MainLayout);
app.use(router);

// Make i18n globally available
app.config.globalProperties.$i18n = i18n;

app.mount('#app');
