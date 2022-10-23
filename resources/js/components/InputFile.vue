<template>
    <div class="w-100 text-center input-file">
        <img id="breed_display_uploaded" @click="fileTrigger" ref="image" class="img-custom-file img-fluid cursor-pointer"
            :src="this.imageUrl" style="max-height: 40rem; max-width: 40rem;">
        <br>
        <small id="breed-lbl-valid" class="w-100 text-danger d-none">La imagen es
            requerida</small>
    </div>
    <input type="text" v-bind:value="imgBase64" class="image-upload-required" id="breed_image_uploaded" name="breed"
        value="" style="position: absolute;z-index: -1;">
    <input type="file" ref="breed_image_upload" hidden id="breed_image_upload" @change="changeImg">
    <input type="text" hidden id="breed_image_uploaded_update" @change="imgUpdate(this)" class="image-uploaded-update">

    <button type="button" @click="deleteImg" class="btn py-50 px-25" id="breed_delete_btn">
        <img class="cursor-pointer mr-25" src="../../images/trash.png" alt="" width="20px">
        <span>Borrar imagen</span>
    </button>
</template>

<script>
export default {
    data() {
        return {
            imageUrl: asset_global_images + '/upload.jpg',
            imgBase64: ''
        };
    },
    components: {
    },
    props: {
        file_name: String,
    },
    mounted() {
    },
    methods: {
        deleteImg() {
            this.imageUrl = asset_global_images + '/upload.jpg';
        },
        fileTrigger() {
            let inputFile = `${this.file_name}_image_upload`;
            this.$refs[inputFile].click();
        },
        changeImg(element, maxSize = 1000) {
            var reader = new FileReader();
            let size_kb = element.target.files[0].size / 1024;
            var ref = this; //avoid overwrites this
            //let size_kb = 400;
            switch (element.target.files[0].type) {
                case 'image/jpeg':
                case 'image/jpg':
                case 'image/png':
                    if (size_kb / 1000 <= maxSize / 1000) {
                        reader.onload = function (e) {
                            var old_base64 = e.target.result;
                            ref.imageUrl = old_base64;
                            ref.imgBase64 = old_base64;
                            ref.$emit('imageUpdate', ref.imgBase64)
                        }
                        reader.readAsDataURL(element.target.files[0]);
                        // $(`#${name}-lbl-valid`).addClass('d-none');
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: `La imágen no puede ser mayor a ${maxSize / 1000} mb. Peso de la imagen actual subida: ${(size_kb / 1000).toFixed(2)} mb aproximadamente.`,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                    break;
                default:
                    Swal.fire({
                        title: '¡Error!',
                        text: `Solo se permiten imágenes con formatos JPG, JPEG y PNG`,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    break;
            }
        },

    }
};

</script>