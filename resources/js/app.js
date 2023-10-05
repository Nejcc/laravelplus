
import './bootstrap';
import { createApp } from 'vue';
import axiosInstance from './axiosInstance';
import { APP_TOKEN, API_BASE_URL } from './constants';

import registerPlugins from './registerPlugins';
import registerComponents from './registerComponents';

const app = createApp({});

// Global Configurations
app.config.globalProperties.$axios = axiosInstance;

// Register Plugins and Components
registerPlugins(app);
registerComponents(app);

// Mount App
app.mount('#app');