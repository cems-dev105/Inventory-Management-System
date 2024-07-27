import { createApp } from 'vue';
import App from './components/App.vue';
import router from './routers/router';
import Toast, { POSITION } from 'vue-toastification';
import "vue-toastification/dist/index.css";

import axios from 'axios';

axios.interceptors.request.use(config => {
  const token = localStorage.getItem('access_token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});


const options = {
    position: POSITION.TOP_RIGHT
  };
// import 'bootstrap/dist/css/bootstrap.min.css';
// import 'bootstrap';

createApp(App).use(router).use(Toast, options).mount('#app');
