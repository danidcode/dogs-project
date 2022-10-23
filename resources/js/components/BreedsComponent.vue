<template>
<div class="content-wrap">
    <div class="breeds-wrap">
        <button @click="createBreed()" class="nueva-breed-button"> Nueva raza <i
                class="fa-solid fa-plus"></i></button>

        <div class="breeds-table-wrap">
            <table class="breeds-table">
                <tr>
                    <th>Imagen
                    </th>
                    <th>Nombre
                        <i class="fa-solid fa-arrow-up-wide-short" @click="sort('name', 'asc')" data-column="nombre"
                            data-order="asc"></i>
                        <i class="fa-solid fa-arrow-down-wide-short" @click="sort('name', 'desc')" data-column="nombre"
                            data-order="desc"></i>

                    </th>
                    <th>Origen
                        <i class="fa-solid fa-arrow-up-wide-short" @click="sort('origin', 'asc')"
                            data-column="limite_usuarios" data-order="asc"></i>
                        <i class="fa-solid fa-arrow-down-wide-short" @click="sort('origin', 'desc')"
                            data-column="limite_usuarios" data-order="desc"></i>
                    </th>
                    <th>Fecha
                        <i class="fa-solid fa-arrow-up-wide-short" @click="sort('created_at', 'asc')" data-column="created_at"
                            data-order="asc"></i>
                        <i class="fa-solid fa-arrow-down-wide-short" @click="sort('created_at', 'desc')"
                            data-column="created_at" data-order="desc"></i>
                    </th>
                    <th>Acciones</th>
                </tr>
                <template v-for="breed in breeds">
                    <tr>
                        <td><img :src='breed.image' alt=""></td>
                        <td>{{ breed.name }}</td>
                        <td>{{ breed.origin }}</td>
                        <td>{{ breed.created_at }}</td>
                        <td><i class="fa-solid fa-ellipsis-vertical" data-bs-toggle="dropdown"
                                aria-expanded="false"></i>
                            <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-start"
                                aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#" @click="getBreed(breed.id,'ver')"><i
                                            class="fa-regular fa-file fa-lg"></i> Ver </a></li>
                                <li><a class="dropdown-item" href="#" @click="getBreed(breed.id,'editar')"><i
                                            class="fa-regular fa-pen-to-square fa-lg"></i> Editar</a></li>
                                <li><a class="dropdown-item" href="#" @click="destroyBreed(breed.id)"><i
                                            class="fa-regular fa-trash-can fa-lg"></i> Borrar </a></li>
                            </ul>
                        </td>

                    </tr>

                </template>
            </table>
        </div>
        <div class="breeds-pagination-wrap">
            <ul class="pagination-list">
                <li><a href="#" @click="previousPage()"><i class="fa-solid fa-chevron-left"></i></a></li>
                <template v-for="page in pages">
                    <li v-if="page < 11 && this.current_page < 11"><a v-bind:class = "(this.current_page == page)&& 'page-active'" href="#" @click="setPage(page)">{{page}}</a></li>
                </template>
                <li><a href="#" @click="nextPage()"><i class="fa-solid fa-chevron-right"></i></a></li>

                
            </ul>
        </div>
    </div>
    <ModalBreedsComponent :getBreeds="getBreeds" :breed="breed" :action="action" />
    <SpinnerComponent v-if="isLoading"/>
</div>
</template>
<script>
import axios from 'axios';
import ModalBreedsComponent from './ModalBreedsComponent.vue';
import SpinnerComponent from './SpinnerComponent.vue'
export default {
    components: {
        ModalBreedsComponent,
        SpinnerComponent
    },
    data() {
        return {
            breeds: [],
            breed: {},
            action: '',
            pages:1,
            orders: null,
            current_page:1,
            isLoading: false
        }
    },
    created() {
        this.getBreeds();

    },
    methods: {

        getBreeds(){
            let url = `/api/breeds?page=${this.current_page}`;
            this.orders != null ? url += `&column=${this.orders.column}&order=${this.orders.order}` : null
                axios.get(url).then(res => {
                    console.log(res);
                const breeds_data = res.data.data;
                const pagination_data = res.data;

                this.breeds = [];
                this.current_page = pagination_data.current_page;
                this.pages = pagination_data.last_page;
                breeds_data.forEach(breed => {
                this.breeds.push(breed)
            });
        })
            
        },
        getBreed(id, action) {
            this.isLoading = true;
                axios.get(`/api/breeds/${id}`).then(res => {
                    this.breed = res.data;
                    this.action = action;
                    this.isLoading = false;
                    $('#modal-breeds').modal('toggle');
                })


        },
        createBreed() {
            $('#modal-breeds').modal('toggle');
            this.action = 'crear';
            this.breed = {}
        },
        destroyBreed(id){
            this.isLoading = true;
            axios.delete(`/api/breeds/${id}`).then(res => {
                this.isLoading = false;
                this.getBreeds();
            })
        },
        setPage(page){
            this.current_page = page;
            this.getBreeds();
        },
        previousPage(){
            this.current_page = this.current_page == 1 ? this.pages : this.current_page - 1;
            this.getBreeds();
        },
        nextPage(){
            this.current_page =  this.current_page == this.pages ? 1 : this.current_page + 1;;
            this.getBreeds();
        },
        sort(column, order){
            const data = {
                column: column,
                order: order
            }
            this.orders = data;
            this.getBreeds();

        }


    }
}
</script>