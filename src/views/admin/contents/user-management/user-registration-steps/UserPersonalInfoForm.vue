<template>
    <div
        class="h-28rem mt-2 flex flex-column p-6 justify-content-center border-1 border-200 border-round-top-md"
    >
        <Toast />
        <div class="personal-info-form">
            <div class="formgrid grid row-gap-5">
                <div class="field col-12 md:col-4">
                    <div class="flex flex-column">
                        <label for="firstName">First name</label>
                        <InputText id="firstName" v-model="user.firstName" />
                    </div>
                </div>
                <div class="field col-12 md:col-4">
                    <div class="flex flex-column">
                        <label for="middleName">Middle name</label>
                        <InputText id="middleName" v-model="user.middleName" />
                    </div>
                </div>
                <div class="field col-12 md:col-4">
                    <div class="flex flex-column">
                        <label for="lastName">Last name</label>
                        <InputText id="lastName" v-model="user.lastName" />
                    </div>
                </div>
                <div class="field col-12 md:col-3">
                    <div class="flex flex-column">
                        <label for="birthDate">Birth date</label>
                        <Calendar
                            inputId="birthDate"
                            v-model="user.birthDate"
                            dateFormat="yy-mm-dd"
                            showIcon
                        />
                    </div>
                </div>
                <div class="field col-12 md:col-3">
                    <div class="flex flex-column">
                        <label for="gender">Gender</label>
                        <Dropdown
                            inputId="gender"
                            v-model="user.gender"
                            :options="genderOptions"
                            optionValue="code"
                            optionLabel="name"
                            placeholder="Select Gender"
                        ></Dropdown>
                    </div>
                </div>
                <div class="field col-12 md:col-3">
                    <div class="flex flex-column">
                        <label for="civilStatus">Civil Status</label>
                        <Dropdown
                            inputId="civilStatus"
                            v-model="user.civilStatus"
                            :options="civilStatusOptions"
                            optionValue="code"
                            optionLabel="name"
                            placeholder="Select Status"
                        ></Dropdown>
                    </div>
                </div>
                <div class="field col-12 md:col-3">
                    <div class="flex flex-column">
                        <label for="userType">User Type</label>
                        <Dropdown
                            inputId="userType"
                            v-model="user.userType"
                            :options="userTypes"
                            optionValue="code"
                            optionLabel="name"
                            placeholder="Select Type"
                        ></Dropdown>
                    </div>
                </div>
                <div class="field col-12 md:col-3">
                    <div class="flex flex-column">
                        <label for="sitio">Sitio</label>
                        <InputText id="sitio" v-model="user.sitio" />
                    </div>
                </div>
                <div class="field col-12 md:col-3">
                    <div class="flex flex-column">
                        <label for="barangay">Barangay</label>
                        <InputText id="barangay" v-model="user.barangay" />
                    </div>
                </div>
                <div class="field col-12 md:col-3">
                    <div class="flex flex-column">
                        <label for="city">City</label>
                        <InputText id="city" v-model="user.city" />
                    </div>
                </div>
                <div class="field col-12 md:col-3">
                    <div class="flex flex-column">
                        <label for="province">Province</label>
                        <InputText id="province" v-model="user.province" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="flex justify-content-end p-3 border-1 border-200 border-round-bottom-md"
    >
        <Button severity="secondary" outlined label="Next" @click="nextForm" />
    </div>
</template>
<script>
import { mapState, mapActions } from "vuex";

export default {
    data() {
        return {
            genderOptions: [
                {
                    name: "Male",
                    code: "Male",
                },
                {
                    name: "Female",
                    code: "Female",
                },
                {
                    name: "Other",
                    code: "Other",
                },
            ],
            civilStatusOptions: [
                {
                    name: "Single",
                    code: "Single",
                },
                {
                    name: "Married",
                    code: "Married",
                },
                {
                    name: "Widowed",
                    code: "Widowed",
                },
                {
                    name: "Divorced",
                    code: "Divorced",
                },
            ],
            userTypes: [
                {
                    name: "Admin",
                    code: "Admin",
                },
                {
                    name: "Farmer",
                    code: "Farmer",
                },
                {
                    name: "Caretaker",
                    code: "Caretaker",
                },
            ],
        };
    },
    methods: {
        async finishForm() {
            this.$router.push({ name: "UserAccountInfoForm" });
        },
    },
    computed: {
        // Map the user state from the registration module
        ...mapState("registration", ["user"]),
    },
    methods: {
        // Map the updateUserField and submitRegistration actions from the registration module
        ...mapActions("registration", [
            "updateUserField",
            "saveUserDataToLocalStorage",
        ]),
        // Method to navigate to the next form
        nextForm() {
            try {
                const formattedBirthDate = new Date(this.user.birthDate)
                    .toISOString()
                    .split("T")[0];
                // Update user data in the store before navigating
                const userFields = {
                    firstName: this.user.firstName,
                    middleName: this.user.middleName,
                    lastName: this.user.lastName,
                    birthDate: formattedBirthDate,
                    gender: this.user.gender,
                    civilStatus: this.user.civilStatus,
                    userType: this.user.userType,
                    sitio: this.user.sitio,
                    barangay: this.user.barangay,
                    city: this.user.city,
                    province: this.user.province,
                };

                // Update user data in the store before navigating
                this.updateUserField({ field: "user", value: userFields });

                // Save user data to localStorage
                this.saveUserDataToLocalStorage();
                // Implement your logic to navigate to the next form (e.g., using router.push)
                this.$router.push({ name: "UserAccountInfoForm" });
            } catch (error) {
                this.$toast.add({
                    severity: "warn",
                    summary: "Validation Error",
                    detail: "Please fill out all required fields before proceeding.",
                    life: 3000,
                });
            }
        },
    },
    created() {
        this.$store
            .dispatch("registration/loadUserDataFromLocalStorage")
    },
};
</script>
<style></style>
