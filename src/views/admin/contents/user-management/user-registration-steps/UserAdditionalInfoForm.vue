<template>
    <div
        class="h-28rem mt-2 flex flex-column p-6 justify-content-center border-1 border-200 border-round-top-md"
    >
        <div class="additional-info-form">
            <div class="grid">
                <div class="col-8">
                    <FileUpload
                        name="file[]"
                        :url="`${baseUrl}upload`"
                        accept="image/*"
                        @upload="onAdvancedUpload($event)"
                        :maxFileSize="3000000"
                        :pt="{
                            thumbnail: {
                                class: 'h-7rem w-auto',
                            },
                            content: { class: 'min-h-9rem' },
                        }"
                    >
                        <template #empty>
                            <p>Drag and drop files to here to upload.</p>
                        </template>
                    </FileUpload>
                </div>
                <div class="col-4 formgrid grid">
                    <div
                        v-if="
                            user.userType !== 'Farmer' ||
                            user.userType !== 'Caretaker'
                        "
                        class="field col-12"
                    >
                        <div class="flex flex-column">
                            <label for="division">Division</label>
                            <InputText id="division" v-model="user.division" />
                        </div>
                    </div>
                    <div
                        v-if="
                            user.userType !== 'Farmer' ||
                            user.userType !== 'Caretaker'
                        "
                        class="field col-12"
                    >
                        <div class="flex flex-column">
                            <label for="position">Position</label>
                            <InputText id="position" v-model="user.position" />
                        </div>
                    </div>
                    <div
                        v-if="
                            user.userType === 'Farmer' ||
                            user.userType === 'Caretaker'
                        "
                        class="field col-12"
                    >
                        <div class="flex flex-column">
                            <label for="yearsFarming">Years of Farming</label>
                            <InputNumber
                                v-model="user.yearsFarming"
                                inputId="yearsFarming"
                                :useGrouping="false"
                            />
                        </div>
                    </div>
                    <div class="field col-12">
                        <div class="flex flex-column">
                            <label for="contactNumber">Contact Number</label>
                            <InputMask
                                id="contactNumber"
                                v-model="user.contactNumber"
                                mask="999-999-9999"
                                placeholder="999-999-9999"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="flex justify-content-between p-3 border-1 border-200 border-round-bottom-md"
    >
        <router-link :to="{ name: 'UserAccountInfoForm' }">
            <Button severity="secondary" outlined label="Prev" />
        </router-link>
        <Button severity="secondary" outlined label="Next" @click="nextForm" />
    </div>
</template>
<script>
const backendUrl = import.meta.env.VITE_APP_API_BASE_URL;
import { mapState, mapActions } from "vuex";

export default {
    data() {
        return {
            baseUrl: backendUrl,
            filePath: "",
        };
    },
    computed: {
        // Map the user state from the registration module
        ...mapState("registration", ["user"]),
    },
    methods: {
        ...mapActions("registration", [
            "updateUserField",
            "saveUserDataToLocalStorage",
        ]),
        nextForm() {
            // Update user data in the store before navigating
            const userFields = {
                division: this.user.division,
                position: this.user.position,
                yearsFarming: this.user.yearsFarming,
                contactNumber: this.user.contactNumber,
                userImage: this.filePath,
            };

            // Update user data in the store before navigating
            this.updateUserField({ field: "user", value: userFields });

            // Save user data to localStorage
            this.saveUserDataToLocalStorage();
            // Implement your logic to navigate to the next form (e.g., using router.push)
            this.$router.push({ name: "UserConfirmRegistration" });
        },
        onAdvancedUpload(event) {
            this.$toast.add({
                severity: "info",
                summary: "Success",
                detail: "File Uploaded",
                life: 3000,
            });
            const responseObj = JSON.parse(event.xhr.response);

            this.filePath = responseObj.path;
        },
        formatSize(bytes) {
            const k = 1024;
            const dm = 3;
            const sizes = this.$primevue.config.locale.fileSizeTypes;

            if (bytes === 0) {
                return `0 ${sizes[0]}`;
            }

            const i = Math.floor(Math.log(bytes) / Math.log(k));
            const formattedSize = parseFloat(
                (bytes / Math.pow(k, i)).toFixed(dm)
            );

            return `${formattedSize} ${sizes[i]}`;
        },
    },
    created() {
        this.$store
            .dispatch("registration/loadUserDataFromLocalStorage")
    },
};
</script>
<style></style>
