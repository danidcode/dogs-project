<template>
    <!-- Modal -->
    <div class="modal fade" id="modal-dogs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modal-dogs" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-dogs-titulo">Perro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <div class="modal-dogs-content">
                
            </div>     -->
                    <form id="dogs-form" ref="dogs_form-form">
                        <div class="form-row d-flex justify-content-around flex-wrap">
                            <div class="col-md-3 mb-3">
                                <label>Nombre</label>
                                <input type="text" ref="name" class="form-control" :value="dog.name"
                                    id="actividad-nombre">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Tamaño</label>
                                <input type="text" ref="size" :value="dog.size" class="form-control"
                                    id="actividad-limite">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Color del pelo </label>
                                <input type="text" ref="hair_color" :value="dog.hair_color" class="form-control"
                                    id="actividad-horario">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Raza </label>
                                <select class="form-select" ref="breed_id" aria-label="Default select example">
                                    <template v-for="breed in breeds">
                                        <option :selected="this.breed_id == breed.id ? true : false" :value="breed.id">{{breed.name}}</option>
                                    </template>
                                    </select>
                            </div>
                        </div>
                        <div class="form-row mt-3  d-flex justify-content-center">
                            <div class="col-6">
                                <label>Imagen</label>
                                <InputFileDog :file_name="file_name" :current_image="dog.image" @imageUpdate="imageUpdate" />
                            </div>
                        </div>
                        <div class="form-row mt-4  d-flex justify-content-center">
                            <input type="hidden" name="" id="record-id" data-id="0">
                            <button v-if="action == 'editar'" type="button" class="btn-actualizar" @click.prevent="submitDog(dog.id)"> Actualizar</button>
                            <button v-if="action == 'crear'" class="btn-crear" type="button"
                                @click.prevent="submitDog()"> Crear</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>
    <SpinnerComponent v-if="isLoading"  />
</template>


<script>
import SpinnerComponent from './SpinnerComponent.vue';
import InputFileDog from './InputFileDog.vue';

export default {
    data() {
        return {
            name: '',
            size: '',
            hair_color: '',
            breed_id: '',
            image: '',
            isLoading: false,
            file_name: 'dog',
            current_image: null
        };
    },
    components: {
    SpinnerComponent,
    InputFileDog
},
    props: {
        dog: Object,
        breeds: Array,
        action: String,
        getDogs: {
            type: Function
        }
    },
    created() {
        this.getDogs();

    },
    methods: {
        submitDog(id = null) {
            this.isLoading = true;
            // Your form submission
            this.name = this.$refs.name.value
            this.size = this.$refs.size.value
            this.hair_color = this.$refs.hair_color.value
            this.breed_id = this.$refs.breed_id.value

            const data = {
                name: this.name,
                size: this.size,
                hair_color: this.hair_color,
                image: this.image,
                breed_id: this.breed_id,

            }
            console.log(data);
            if(id != null){
                axios.put(`/api/dogs/${id}`, data).then(res => {
                this.isLoading = false;
                this.getDogs();
            }) 
            }else{
                axios.post(`/api/dogs`, data).then(res => {
                this.isLoading = false;
                this.getDogs();
            })
            
        }

    },
    imageUpdate(value){
        this.image = value;
    }
}
};

</script>
