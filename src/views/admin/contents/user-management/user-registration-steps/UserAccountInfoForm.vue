<template>
    <div
        class="h-28rem mt-2 flex flex-column p-6 justify-content-center border-1 border-200 border-round-top-md"
    >
        <Toast />
        <div class="account-info-form">
            <div class="flex justify-content-center align-content-center">
                <div class="grid">
                    <div class="formgrid grid row-gap-3 col-6">
                        <div class="field col-12">
                            <div class="flex flex-column">
                                <label for="username">Username</label>
                                <InputGroup>
                                    <InputGroupAddon>
                                        <i class="pi pi-user"></i>
                                    </InputGroupAddon>
                                    <InputText
                                        id="username"
                                        v-model="user.username"
                                        placeholder="Username"
                                    />
                                </InputGroup>
                            </div>
                        </div>
                        <div class="field col-12">
                            <div class="flex flex-column">
                                <label for="email">Email Address</label>
                                <InputGroup>
                                    <InputGroupAddon>
                                        <i class="pi pi-envelope"></i>
                                    </InputGroupAddon>
                                    <InputText
                                        id="email"
                                        v-model="user.email"
                                        placeholder="Email Address"
                                    />
                                </InputGroup>
                            </div>
                        </div>
                        <div class="field col-12">
                            <div class="flex flex-column">
                                <label for="password">Password</label>

                                <InputGroup>
                                    <InputGroupAddon>
                                        <i class="pi pi-lock"></i>
                                    </InputGroupAddon>
                                    <Password
                                        inputId="password"
                                        v-model="user.password"
                                        placeholder="Password"
                                        :toggleMask="true"
                                        class="w-full"
                                        inputClass="w-full"
                                    ></Password>
                                </InputGroup>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
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
                </div>
            </div>
        </div>
    </div>
    <div
        class="flex justify-content-between p-3 border-1 border-200 border-round-bottom-md"
    >
        <router-link :to="{ name: 'AdminRegisterUser' }">
            <Button severity="secondary" outlined label="Prev" />
        </router-link>
        <Button severity="secondary" outlined label="Next" @click="nextForm" />
    </div>
</template>
<script>
import { mapState, mapActions } from "vuex";
const backendUrl = import.meta.env.VITE_APP_API_BASE_URL;

export default {
    data(){
        return {
            baseUrl: backendUrl,
            filePath: "",
        };
    },
    computed: {
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
                username: this.user.username,
                email: this.user.email,
                password: this.user.password,
                userImage: this.filePath
            };

            if (
                userFields.username === undefined ||
                userFields.email === undefined ||
                userFields.password === undefined
            ) {
                // Display a warning toast with specific details
                this.$toast.add({
                    severity: "warn",
                    summary: "Validation Error",
                    detail: "Please fill out all required fields before proceeding.",
                    life: 3000,
                });
                console.log(userFields);
                return; // Exit the function to prevent further execution
            }

            // Update user data in the store before navigating
            this.updateUserField({ field: "user", value: userFields });
            this.saveUserDataToLocalStorage();

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
        this.$store.dispatch("registration/loadUserDataFromLocalStorage");
    },
};
</script>
<style></style>
