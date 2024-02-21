<template>
    <div
        class="login-page min-w-screen min-h-screen flex flex-column justify-content-center align-items-center overflow-hidden"
    >
        <div
            class="bg-white flex justify-content-center align-items-center border-round-3xl shadow-4"
        >
            <div class="px-7 py-6">
                <div class="flex w-full justify-content-between">
                    <Image src="/images/logo/3HEADS OUTLINE.png" width="100" />
                    <div class="text-left mb-5 ml-3">
                        <div
                            class="text-900 font-bold"
                            style="font-size: 48px"
                        >
                            Welcome Back!
                        </div>
                        <span class="text-lg text-600 font-medium"
                            >Sign in to continue</span
                        >
                    </div>
                </div>
                <div>
                    <label
                        for="email1"
                        class="block text-900 text-xl font-medium mb-2"
                        >Username</label
                    >
                    <InputText
                        id="email1"
                        type="text"
                        placeholder="Username"
                        class="w-full md:w-30rem mb-5"
                        style="padding: 1rem"
                        v-model="username"
                    />

                    <label
                        for="password1"
                        class="block text-900 font-medium text-xl mb-2"
                        >Password</label
                    >
                    <Password
                        id="password1"
                        v-model="password"
                        placeholder="Password"
                        :toggleMask="true"
                        class="w-full mb-3"
                        inputClass="w-full"
                        :inputStyle="{ padding: '1rem' }"
                        :feedback="false"
                    ></Password>
                    <InlineMessage
                        v-if="invalidMessage"
                        class="mb-3 w-full"
                        severity="error"
                        >{{ errorMessage }}</InlineMessage
                    >

                    <div
                        class="flex align-items-center justify-content-between mb-5 gap-5"
                    >
                        <div class="flex align-items-center">
                            <Checkbox
                                v-model="checked"
                                id="rememberme1"
                                binary
                                class="mr-2"
                            ></Checkbox>
                            <label for="rememberme1">Remember me</label>
                        </div>
                        <a
                            class="font-medium no-underline ml-2 text-right cursor-pointer"
                            style="color: var(--primary-color)"
                            >Forgot password?</a
                        >
                    </div>
                    <Button
                        label="Sign In"
                        class="w-full p-3 text-xl"
                        @click="loginAuth"
                        :loading="loading"
                    ></Button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { jwtDecode as jwt_decode } from "jwt-decode";
import { setCookie } from "@/utils/CookieUtils";

export default {
    data() {
        return {
            username: "",
            password: "",
            checked: false,
            errorMessage: "",
            invalidMessage: false,
            loading: false,
        };
    },
    computed: {
        loginDate() {
            // Get the individual components of the date
            const date = new Date()
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(
                2,
                "0"
            ); // Adding 1 because getMonth returns zero-based month
            const day = String(date.getDate()).padStart(2, "0");
            const hours = String(date.getHours()).padStart(2, "0");
            const minutes = String(date.getMinutes()).padStart(
                2,
                "0"
            );
            const seconds = String(date.getSeconds()).padStart(
                2,
                "0"
            );

            // Construct the formatted date string
            const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

            return formattedDate;
        },
        token() {
            return this.$store.state.pushNotifToken;
        },
    },
    methods: {
        async loginAuth() {
            this.loading = true;
            try {
                const response = await axios.post("/login", {
                    username: this.username,
                    password: this.password,
                    loginDate: this.loginDate,
                    token: this.token,
                });
                if (!response.data.login) {
                    // response.data.error // this contains an error message that says "Invalid username or password"
                    this.errorMessage = response.data.error;
                    this.password = "";
                    this.invalidMessage = true;
                } else {
                    const decodedToken = jwt_decode(response.data.token);
                    const userRole = decodedToken.aud;

                    console.log(userRole);

                    // Set the token as an HTTP-only cookie with an expiration time
                    setCookie("token", response.data.token, 1); // 1 day expiration

                    this.loading = false;

                    switch (userRole) {
                        case "Farmer":
                        case "Care Taker":
                            this.$router.push({ name: "FarmerDashboard" });
                            break;
                        case "DA Personnel":
                            this.$router.push({ name: "AdminDashboard" });
                            break;
                        // Handle other roles if needed
                        default:
                            this.$router.push("/login");
                    }
                }
            } catch (error) {
                console.log(error.message);
            }
        },
    },
};
</script>
<style></style>
