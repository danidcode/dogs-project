
<template>
     <div id="main" class="main">
        <div class="sidebar">
            <a class="" @click="changeComponent('razas')">Configurar Razas</a>
            <a class="" @click="changeComponent('perros')">Configurar Perros</a>
        </div>
        <div class="content">
        <div class="content-wrap">
            <BreedsComponent v-if="this.component == 'razas'"/>
            <DogsComponent v-if="this.component == 'perros'"/>
        </div>
    </div>
    </div>
</template>

<script>
import BreedsComponent from './BreedsComponent.vue';
import DogsComponent from './DogsComponent.vue';
export default {
    components: {
        BreedsComponent,
        DogsComponent
    },
    data() {
        return {
            component: null
        }
    },
    methods: {
        changeComponent(component){
            console.log(component);
            this.component = component;
        }
    }
}
</script>




