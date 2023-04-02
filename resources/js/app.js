import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import router from './Router/index';
import App from './components/App.vue';
import { createPinia } from 'pinia';

const pinia=createPinia()

createApp({
    components: {
        App
    }
}).use(router)
.use(pinia)
.mount("#app")