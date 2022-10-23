<template>
    <!-- Modal -->
    <div class="modal fade" id="modal-breeds" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modal-breeds" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-breeds-titulo">Raza</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <div class="modal-breeds-content">
                
            </div>     -->
                    <form id="breeds-form" ref="breeds_form-form">
                        <div class="form-row d-flex justify-content-around flex-wrap">
                            <div class="col-md-3 mb-3">
                                <label>Nombre</label>
                                <input type="text" ref="name" class="form-control" :value="breed.name">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Origen</label>
                                <input type="text" ref="origin" :value="breed.origin" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mt-3  d-flex justify-content-center">
                            <div class="col-6">
                                <label>Imagen</label>
                                <InputFileBreed :file_name="file_name" :current_image="breed.image" @imageUpdate="imageUpdate" />
                            </div>
                        </div>
                        <div class="form-row mt-4  d-flex justify-content-center">
                            <input type="hidden" name="" id="record-id" data-id="0">
                            <button v-if="action == 'editar'" type="button" class="btn-actualizar"
                                @click.prevent="submitBreed(breed.id)"> Actualizar</button>
                            <button v-if="action == 'crear'" class="btn-crear" type="button"
                                @click.prevent="submitBreed()"> Crear</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>
    <SpinnerComponent v-if="isLoading" />
</template>


<script>
import SpinnerComponent from './SpinnerComponent.vue';
import InputFileBreed from './InputFileBreed.vue';

export default {
    data() {
        return {
            name: '',
            origin: '',
            image: '',
            isLoading: false,
            file_name: 'breed',
            current_image: null
        };
    },
    components: {
        SpinnerComponent,
        InputFileBreed
    },
    props: {
        breed: Object,
        action: String,
        getBreeds: {
            type: Function
        }
    },
    created() {
        this.getBreeds();

    },
    methods: {
        submitBreed(id = null) {
            this.isLoading = true;
            // Your form submission
            this.name = this.$refs.name.value
            this.origin = this.$refs.origin.value

            const data = {
                name: this.name,
                origin: this.origin,
                image: this.image,


            }
            if (id != null) {
                axios.put(`/api/breeds/${id}`, data).then(res => {
                    this.isLoading = false;
                    this.getBreeds();
                })
            } else {
                axios.post(`/api/breeds`, data).then(res => {
                    this.isLoading = false;
                    this.getBreeds();
                })

            }

        },
        imageUpdate(value) {
            this.image = value;
        }
    }
};

</script>
