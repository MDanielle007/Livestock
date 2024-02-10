<template>
    <div>
        <Toolbar class="bg-white">
            <template #start>
                <router-link :to="{ name: 'AdminUserManagement' }">
                    <Button icon="pi pi-arrow-left" class="mr-2" />
                </router-link>
            </template>
            <template #center>
                <Steps
                    v-model:activeStep="active"
                    :model="registrationSteps"
                    :pt="{
                        action: {
                            class: 'px-5',
                        },
                    }"
                />
            </template>
        </Toolbar>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
const backendUrl = import.meta.env.VITE_APP_API_BASE_URL;

export default {
    data() {
        return {
            baseUrl: backendUrl,
            uploadedFiles: [],
            visiblePIF: true,
            active: 0,
            registrationSteps: [
                {
                    label: "Personal Information",
                },
                {
                    label: "Account Information",
                },
                {
                    label: "Confirm Registration",
                },
            ],
        };
    },
    watch: {
        "$route.name": function (newRouteName, oldRouteName) {
            switch (newRouteName) {
                case "AdminRegisterUser":
                    this.active = 0;
                    break;
                case "UserAccountInfoForm":
                    this.active = 1;
                    break;
                case "UserConfirmRegistration":
                    this.active = 2;
                    break;
                default:
            }
        },
    },
};
</script>
<style scoped>
.personal-info-form {
    display: none;
}

.account-info-form {
    display: none;
}

.additional-info-form {
    display: none;
}
</style>
