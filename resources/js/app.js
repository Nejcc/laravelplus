import './bootstrap';
import {createApp, useTransitionState} from 'vue';
import { createPinia } from 'pinia'
import axiosInstance from './axiosInstance';
import { APP_TOKEN, API_BASE_URL } from './constants';
import axios from 'axios';

import registerPlugins from './registerPlugins';
import registerComponents from './registerComponents';
import {useTranslationsState} from "./states/TranslationState.js";

const app = createApp({});

const pinia = createPinia()

// Global Configurations
app.config.globalProperties.$axios = axiosInstance;

app.use(pinia)

// Register Plugins and Components
registerPlugins(app);
registerComponents(app);

// Assuming the translations are passed to the window object
const translationsState = useTranslationsState();
window.translations = {};
translationsState.setTranslations(window.translations);

// Set up axios defaults
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;

// Mount App
app.mount('#app');