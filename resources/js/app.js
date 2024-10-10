
import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia'
import axiosInstance from './axiosInstance';
import { APP_TOKEN, API_BASE_URL } from './constants';

import registerPlugins from './registerPlugins';
import registerComponents from './registerComponents';

const app = createApp({});

const pinia = createPinia()

// Global Configurations
app.config.globalProperties.$axios = axiosInstance;

app.use(pinia)

// Register Plugins and Components
registerPlugins(app);
registerComponents(app);

// Mount App
app.mount('#app');