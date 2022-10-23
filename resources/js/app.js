import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';

import Appcomponent from './components/AppComponent.vue';
import HomeComponent from './components/HomeComponent.vue';
import BreedsComponent from './components/BreedsComponent.vue';
import router from './router/index';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css';
const app = createApp({
  components: {
    Appcomponent,
    HomeComponent,
    BreedsComponent
  },
  methods: {
    greet: function (event) {
      // `this` inside methods point to the Vue instance
      alert('Hello ' + this.name + '!')
      // `event` is the native DOM event
      alert(event.target.tagName)
    }
  },
  created: function() {
    this.isLoading = false;
  }

});

app.use(router);
app.mount("#app");

