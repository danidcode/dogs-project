import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';

import Appcomponent from './components/AppComponent.vue'
import HomeComponent from './components/HomeComponent.vue'
import router from './router/index';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css';
const app = createApp({
  components: {
    Appcomponent,
    HomeComponent
  },
  methods: {
    greet: function (event) {
      // `this` inside methods point to the Vue instance
      alert('Hello ' + this.name + '!')
      // `event` is the native DOM event
      alert(event.target.tagName)
    }
  }

});

app.use(router);
app.mount("#app");

