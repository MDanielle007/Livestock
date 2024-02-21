<template>
    <div>
        <Dialog
            v-model:visible="editFarmerProfileDialog"
            modal
            header="Farmer Profile"
            :style="{ width: '22rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12">
                    <InputText
                        v-model="editUserProfile.username"
                        placeholder="First name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12">
                    <InputText
                        v-model="editUserProfile.firstName"
                        placeholder="First name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12">
                    <InputText
                        v-model="editUserProfile.middleName"
                        placeholder="Middle Name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12">
                    <InputText
                        v-model="editUserProfile.lastName"
                        placeholder="Last Name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12">
                    <Calendar
                        inputId="birthDate"
                        v-model="editUserProfile.birthDate"
                        dateFormat="yy-mm-dd"
                        class="w-full"
                        showIcon
                    />
                </div>
                <div class="field col-12">
                    <Dropdown
                        class="w-full"
                        inputId="gender"
                        v-model="editUserProfile.gender"
                        :options="genderOptions"
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select Gender"
                    ></Dropdown>
                </div>
                <div class="field col-12">
                    <Dropdown
                        class="w-full"
                        inputId="civilStatus"
                        v-model="editUserProfile.civilStatus"
                        :options="civilStatusOptions"
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select Status"
                    ></Dropdown>
                </div>
                <div class="field col-12">
                    <Dropdown
                        class="w-full"
                        inputId="userType"
                        v-model="editUserProfile.userType"
                        :options="userTypes"
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select Type"
                    ></Dropdown>
                </div>
                <div class="field col-12">
                    <InputText
                        v-model="editUserProfile.sitio"
                        placeholder="Sitio"
                        class="w-full"
                    />
                </div>
                <div class="field col-12">
                    <InputText
                        v-model="editUserProfile.barangay"
                        placeholder="Barangay"
                        class="w-full"
                    />
                </div>
                <div class="field col-12">
                    <InputText
                        v-model="editUserProfile.city"
                        placeholder="City"
                        class="w-full"
                    />
                </div>
                <div class="field col-12">
                    <InputText
                        v-model="editUserProfile.province"
                        placeholder="Province"
                        class="w-full"
                    />
                </div>
            </div>
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
        <div class="flex px-3">
            <Image
                :src="user.userImage"
                :alt="user.userId"
                width="120"
                preview
                :pt="{
                    image: { class: 'border-circle' },
                    button: { class: 'border-circle' },
                }"
            />
            <div class="flex-1 flex flex-column justify-content-center p-3">
                <div class="text-2xl font-bold">
                    {{ user.username }}
                </div>
                <div class="text-lg font-semibold">
                    {{ user.userId }}
                </div>
                <div>
                    <span class="font-medium">livestocks</span> :
                    {{ user.livestocksOwned }}
                </div>
            </div>
        </div>
        <div
            class="bg-white h-24rem mt-3 border-round-lg flex flex-column px-2 py-2"
        >
            <div class="flex flex-column gap-2 px-3 py-2">
                <div>
                    <div class="text-xl">
                        {{ fullName }}
                    </div>
                </div>
                <div>
                    <span class="text-sm">Email</span>
                    <div class="text-xl">
                        {{ user.email }}
                    </div>
                </div>
                <div>
                    <span class="text-sm">Address</span>
                    <div class="text-lg">
                        {{ getFullAddress() }}
                    </div>
                </div>
            </div>

            <div class="grid grid-nogutter p-3 border-round-lg mb-4">
                <div class="col-6 mb-2">
                    <small>Date Of Birth</small>
                    <div class="text-lg">
                        {{ user.birthDate }}
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <small>Civil Status</small>
                    <div class="text-lg">
                        {{ user.civilStatus }}
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <small>Gender</small>
                    <div class="text-lg">
                        {{ user.gender }}
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <small>User</small>
                    <div class="text-lg">
                        {{ user.userType }}
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <Button
                    class="flex-1"
                    icon="pi pi-user-edit"
                    @click="openEditProfile"
                    outlined
                    label="Edit Profile"
                />
                <Button
                    class="flex-1"
                    icon="pi pi-sign-out"
                    outlined
                    @click="userLogout"
                    severity="danger"
                    label="Sign Out"
                />
            </div>
        </div>
    </div>
</template>
<script>
import FarmerEditProfileDialog from "@/components/farmer/FarmerEditProfileDialog.vue";
import { getCookie, clearToken } from "@/utils/CookieUtils";
import { jwtDecode as jwt_decode } from 'jwt-decode';
import axios from "axios";

export default {
    data() {
        return {
            user: {
                userId: "FMR-101",
                username: "Mdanielle007",
                firstName: "Marc Danielle",
                middleName: "Marasigan",
                lastName: "Cabatay",
                email: "danielle@gmail.com",
                phone: "09517412216",
                gender: "Male",
                birthDate: "2002-10-26",
                civilStatus: "Single",
                sitio: "Lagunlong",
                barangay: "Water",
                city: "Baco",
                province: "Oriental Mindoro",
                userType: "Farmer",
                userImage: "/images/default-picture.jpg",
                livestocksOwned: "8",
            },
            editUserProfile: {
                userId: "",
                username: "",
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                phone: "",
                gender: "",
                birthDate: "",
                civilStatus: "",
                sitio: "",
                barangay: "",
                city: "",
                province: "",
                userType: "",
            },
            fullName: "",
            editFarmerProfileDialog: false,
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
    components: {
        FarmerEditProfileDialog,
    },
    methods: {
        async getFullName() {
            const { firstName, middleName, lastName } = await this.user;
            let fullName = "";

            if (firstName) {
                fullName += firstName;
            }

            if (lastName) {
                fullName += (fullName ? " " : "") + lastName;
            }

            this.fullName = fullName;
        },
        getFullAddress() {
            const { sitio, barangay, city, province } = this.user;
            let fullAddress = "";

            if (sitio) {
                fullAddress += sitio + ", ";
            }

            if (barangay) {
                fullAddress += barangay + ", ";
            }

            if (city) {
                fullAddress += city + ", ";
            }

            if (province) {
                fullAddress += province;
            }

            return fullAddress;
        },
        saveProfile(updatedUser) {
            // Handle the saved user object
            console.log("Saved user:", updatedUser);
            // You can update the user object in the parent component if needed
            this.user = updatedUser;
            // Close the dialog after saving
            this.editFarmerProfileDialog = false;
        },
        async openEditProfile() {
            this.editUserProfile = await this.user;
            this.editFarmerProfileDialog = true;
        },
        async userLogout() {
            const token = getCookie("token");

            const decodedToken = jwt_decode(token);

            const id = decodedToken.sub.id;

            const response = await axios.post("logout", { id: id });

            console.log(response);

            clearToken();

            // Redirect to the login page or any desired destination
            this.$router.push("/login");
        },
    },
    created() {
        this.getFullName();
    },
};
</script>
<style></style>
