import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';

import Appcomponent from './components/AppComponent.vue'
import HomeComponent from './components/HomeComponent.vue'
import router from './router/index';

const app = createApp({
    components:{
        Appcomponent,
        HomeComponent
    },

});

app.use(router);

app.mount("#app");

