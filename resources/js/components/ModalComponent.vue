<template>
<!-- Modal -->
<div class="modal fade" id="modal-breeds" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-breeds" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-breeds-titulo">Ver actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <div class="modal-breeds-content">
                
            </div>     -->
                <form id="breeds-form">
                    <div class="form-row d-flex justify-content-around">
                        <div class="col-md-3 mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" :value="breed.name" id="actividad-nombre">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Tamaño</label>
                            <input type="text" :value="breed.size" class="form-control" id="actividad-limite">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Color del pelo </label>
                            <input type="text" :value="breed.hair_color" class="form-control" id="actividad-horario">
                        </div>
                    </div>
                    <div class="form-row mt-3  d-flex justify-content-center">
                        <div class="col-6">
                            <label>Imagen</label>              
                        </div>
                    </div>
                    <div class="form-row mt-4  d-flex justify-content-center">
                    <input type="hidden" name="" id="record-id" data-id="0">
                        <button v-if="action == 'editar'" type="button" class="btn-actualizar" onclick="updateActividad()"> Actualizar</button>
                        <button v-if="action == 'crear'" type="button" class="btn-crear" onclick="createActividad()"> Crear</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>

</template>


<script>
export default {
  data() {
    return {};
  },
  props:{
    breed: Object,
    action: String,
  }
};

</script>
