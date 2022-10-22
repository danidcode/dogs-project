
<template>

  <ModalComponent :breed="breed" :action="action" />
    <div class="content">
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
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="nombre"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="nombre"
                                    data-order="desc"></i>

                            </th>
                            <th>Tamaño
                                <i class="fa-solid fa-arrow-up-wide-short" @click="sort(this)"
                                    data-column="limite_usuarios" data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                    data-column="limite_usuarios" data-order="desc"></i>
                            </th>
                            <th>Color de pelo
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="horario"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="horario"
                                    data-order="desc"></i>
                            </th>
                            <th>Creada
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="created_at"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                    data-column="created_at" data-order="desc"></i>
                            </th>
                            <th>Acciones</th>
                        </tr>
                        <template v-for="bred in breeds">
                            <tr>
                                <td>{{ bred.name }}</td>
                                <td>{{ bred.name }}</td>
                                <td>{{ bred.size }}</td>
                                <td>{{ bred.hair_color }}</td>
                                <td>{{ bred.created_at }}</td>
                                <td><i class="fa-solid fa-ellipsis-vertical" data-bs-toggle="dropdown"
                                        aria-expanded="false"></i>
                                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-start"
                                        aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#" @click="getBreed(bred.id,'ver')"><i
                                                    class="fa-regular fa-file fa-lg"></i> Ver </a></li>
                                        <li><a class="dropdown-item" href="#" @click="getBreed(bred.id,'editar')"><i
                                                    class="fa-regular fa-pen-to-square fa-lg"></i> Editar</a></li>
                                        <li><a class="dropdown-item" href="#" @click="destroyBreed()"><i
                                                    class="fa-regular fa-trash-can fa-lg"></i> Borrar </a></li>
                                    </ul>
                                </td>

                            </tr>

                        </template>
                    </table>
                </div>
                <div class="breeds-pagination-wrap">
                    <ul class="pagination-list">
                        <li><a href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                        <li><a href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="spinner-loading" v-if="isLoading">
  <div class="text-center loading">
      <div class="spinner-border" role="status">
      </div>
  </div>
</div>
</template>

<script>
import ModalComponent from './ModalComponent.vue'
export default {
    components: {
        ModalComponent
    },
    data() {
        return {
            breeds: [],
            breed:{},
            action: '',
            isLoading : false
        }
    },
    created() {
        axios.get('/api/breeds').then(res => {
            res.data.forEach(breed => {
                this.breeds.push(breed)
            });
        })
       
    },
    methods: {
         getBreed(id, action) {
            this.isLoading = true,
            axios.get(`/api/breeds/${id}`).then(res => {
                this.breed = res.data;
                this.action = action;
                this.isLoading = false;
                $('#modal-breeds').modal('toggle');
            })
            
            
        },
        createBreed(){
            $('#modal-breeds').modal('toggle');
            this.breed = {}
            
        }


    }
}
</script>
