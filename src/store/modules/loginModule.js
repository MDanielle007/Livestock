import axios from "axios";
export default {
    namespaced: true,
    state: {
        user: {},
    },
    getters: {},
    mutations: {
        // Mutation to update a specific user field
        updateUserState(state, { field, value }) {
            state.user[field] = value;
        },
        // Mutation to reset the user state
        resetUserState(state) {
            state.user = {};
        },
    },
    actions: {
        // Action to update a specific user field
        updateUserField({ commit }, payload) {
            commit("updateUserField", payload);
        },
        // Action to reset the user state
        resetUserState({ commit }) {
            commit("resetUserState");
        },
        // Action to submit the user registration
        async submitLogin(state) {
            try {
                // Implement your logic to send the registration data to the server
                // You can use state.user to access the user data
                const response = await axios.post(
                    "login",
                    state.user
                );

                // Handle success response
                console.log("Login successful:", response.data);

                dispatch("resetUserState");
                this.$router.push({ name: "AdminViewUsers" });
            } catch (error) {
                // Handle error
                console.error("Error during registration:", error.message);
                // You might want to show an error message to the user or perform other actions
            }
        },
    },
    modules: {},
};
