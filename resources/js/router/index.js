import { createRouter, createWebHistory } from "vue-router";

const Appcomponent = () => import( '../components/AppComponent.vue');
const HomeComponent = () => import( '../components/HomeComponent.vue');
const BreedsComponent = () => import( '../components/BreedsComponent.vue');
const routes  = [
    {
        path: '/home',
        name: 'home',
        component: HomeComponent
    },
    {
        path: '/',
        name: 'welcome',
        component: Appcomponent
    }
]

const router =  createRouter({
    history: createWebHistory(),
    routes
});

export default router;