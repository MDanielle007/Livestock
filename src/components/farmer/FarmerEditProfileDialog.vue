<template>
    <Dialog
        v-model:visible="visibleDialog"
        @update:visible="$emit('update:visible', $event)"
        modal
        header="Farmer Profile"
        :style="{ width: '22rem' }"
    >
        <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto"></div>
        <div class="flex justify-content-end gap-2 border-top-1 p-2">
            <Button
                type="button"
                label="Close"
                severity="secondary"
                @click="editFarmerProfileDialog = false"
            ></Button>
            <Button
                type="button"
                label="Save"
                @click="saveEditProfile(user)"
            ></Button>
        </div>
    </Dialog>
</template>
<script>
export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
        visible: Boolean, // Define 'visible' as a prop
    },
    data() {
        return {
            visibleDialog: false, // Initialize 'visible' as a local data property
        };
    },
    watch: {
        visible(newValue) {
            // Update the local 'visible' data property when the prop value changes
            this.visibleDialog = newValue;
        },
        visibleDialog(newValue) {
            // Emit the 'update:value' event to notify the parent component of changes to the dialog's visibility
            this.$emit("update:value", newValue);
        },
    },
};
</script>
<style></style>
