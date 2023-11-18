<template>
    <v-file-input
        class=""
        label="File input"
        variant="outlined"
        prepend-icon="fa-solid fa-camera"
        v-model="selectedFile"
        @change="handleFileChange"
    ></v-file-input>
</template>
<script>
export default {
    name: "FileUploadButton",
    data (){
        return{
            selectedFile: "", // Local data property for selectedFile
        }
    },
    methods: {
        getObjectURL(file) {
            if (file) {
                return URL.createObjectURL(file);
            }
            return null;
        },
        handleFileChange(event) {
            console.log("Selected File in handleFileChange:", event.target.files[0]);
            this.selectedFile = event.target.files;
        },
    },
}
</script>