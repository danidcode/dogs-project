<template>
    <div class="content-wrap">
        <div class="dogs-wrap">
            <button @click="createDog()" class="nuevo-dog-button"> Nuevo perro <i
                    class="fa-solid fa-plus"></i></button>
    
            <div class="dogs-table-wrap">
                <table class="dogs-table">
                    <tr>
                        <th>Imagen
                        </th>
                        <th>Nombre
                            <i class="fa-solid fa-arrow-up-wide-short" @click="sort('name', 'asc')"
                                data-order="asc"></i>
                            <i class="fa-solid fa-arrow-down-wide-short" @click="sort('name', 'desc')" 
                                data-order="desc"></i>
    
                        </th>
                        <th>Tamaño
                            <i class="fa-solid fa-arrow-up-wide-short" @click="sort('size', 'asc')"
                                 data-order="asc"></i>
                            <i class="fa-solid fa-arrow-down-wide-short" @click="sort('size', 'desc')"
                                 data-order="desc"></i>
                        </th>
                        <th>Color de pelo
                            <i class="fa-solid fa-arrow-up-wide-short" @click="sort('hair_color', 'asc')" 
                                data-order="asc"></i>
                            <i class="fa-solid fa-arrow-down-wide-short" @click="sort('hair_color', 'desc')" 
                                data-order="desc"></i>
                        </th>
                        <th>Fecha
                            <i class="fa-solid fa-arrow-up-wide-short" @click="sort('created_at', 'asc')" 
                                data-order="asc"></i>
                            <i class="fa-solid fa-arrow-down-wide-short" @click="sort('created_at', 'desc')"
                                 data-order="desc"></i>
                        </th>
                        <th>Acciones</th>
                    </tr>
                    <template v-for="dog in dogs">
                        <tr>
                            <td><img :src='dog.image' alt=""></td>
                            <td>{{ dog.name }}</td>
                            <td>{{ dog.size }}</td>
                            <td>{{ dog.hair_color }}</td>
                            <td>{{ dog.created_at }}</td>
                            <td><i class="fa-solid fa-ellipsis-vertical" data-bs-toggle="dropdown"
                                    aria-expanded="false"></i>
                                <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-start"
                                    aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#" @click="getDog(dog.id,'ver')"><i
                                                class="fa-regular fa-file fa-lg"></i> Ver </a></li>
                                    <li><a class="dropdown-item" href="#" @click="getDog(dog.id,'editar')"><i
                                                class="fa-regular fa-pen-to-square fa-lg"></i> Editar</a></li>
                                    <li><a class="dropdown-item" href="#" @click="destroyDog(dog.id)"><i
                                                class="fa-regular fa-trash-can fa-lg"></i> Borrar </a></li>
                                </ul>
                            </td>
    
                        </tr>
    
                    </template>
                </table>
            </div>
            <div class="dogs-pagination-wrap">
                <ul class="pagination-list">
                    <li><a href="#" @click="previousPage()"><i class="fa-solid fa-chevron-left"></i></a></li>
                    <template v-for="page in pages">
                        <li v-if="page < 11 && this.current_page < 11"><a v-bind:class = "(this.current_page == page)&& 'page-active'" href="#" @click="setPage(page)">{{page}}</a></li>
                    </template>
                    <li><a href="#" @click="nextPage()"><i class="fa-solid fa-chevron-right"></i></a></li>
    
                    
                </ul>
            </div>
        </div>
         <ModalDogsComponent :getDogs="getDogs" :dog="dog" :breeds="breeds" :action="action" />
        <SpinnerComponent v-if="isLoading"/>
    </div>
    </template>
    <script>
    import axios from 'axios';
    import ModalDogsComponent from './ModalDogsComponent.vue';
    import SpinnerComponent from './SpinnerComponent.vue'
    export default {
        components: {
            ModalDogsComponent,
            SpinnerComponent
        },
        data() {
            return {
                dogs: [],
                breeds: [],
                dog: {},
                action: '',
                pages:1,
                orders: null,
                current_page:1,
                isLoading: false
            }
        },
        created() {
            this.getDogs();
    
        },
        methods: {
    
            getDogs(){
                let url = `/api/dogs?page=${this.current_page}`;
                this.orders != null ? url += `&column=${this.orders.column}&order=${this.orders.order}` : null
                    axios.get(url).then(res => {
                    const dogs_data = res.data.dogs.data;
                    const pagination_data = res.data.dogs;
                    const breeds = res.data.breeds;
    
                    this.dogs = [];
                    this.current_page = pagination_data.current_page;
                    this.pages = pagination_data.last_page;
                    dogs_data.forEach(dog => {
                    this.dogs.push(dog)
                });
                this.breeds = [];
                breeds.forEach(breed => {
                    this.breeds.push(breed)
                });
            })
                
            },
            getDog(id, action) {
                this.isLoading = true;
                    axios.get(`/api/dogs/${id}`).then(res => {
                        this.dog = res.data;
                        this.action = action;
                        this.isLoading = false;
                        $('#modal-dogs').modal('toggle');
                    })
    
    
            },
            createDog() {
                $('#modal-dogs').modal('toggle');
                this.action = 'crear';
                this.dog = {}
            },
            destroyDog(id){
                this.isLoading = true;
                axios.delete(`/api/dogs/${id}`).then(res => {
                    this.isLoading = false;
                    this.getDogs();
                })
            },
            setPage(page){
                this.current_page = page;
                this.getDogs();
            },
            previousPage(){
                this.current_page = this.current_page == 1 ? this.pages : this.current_page - 1;
                this.getDogs();
            },
            nextPage(){
                this.current_page =  this.current_page == this.pages ? 1 : this.current_page + 1;;
                this.getDogs();
            },
            sort(column, order){
                const data = {
                    column: column,
                    order: order
                }
                this.orders = data;
                this.getDogs();
    
            }
    
    
        }
    }
    </script>