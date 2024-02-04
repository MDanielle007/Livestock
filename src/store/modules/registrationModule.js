// Import the necessary functions for localStorage
const localStorageKey = "registrationUserData";

import axios from "axios";

export default {
    namespaced: true,
    state: {
        user: {},
    },
    getters: {},
    mutations: {
        // Mutation to update a specific user field
        updateUserField(state, { field, value }) {
            if (field === "user" && typeof value === "object") {
                state.user = { ...state.user, ...value };
            } else {
                state.user[field] = value;
            }
            console.log(`Updated user field: ${field}, value: ${value}`);
        },
        // Mutation to reset the user state
        resetUserState(state) {
            state.user = {};
        },
    },
    actions: {
        // Action to update a specific user field
        updateUserField({ commit, dispatch }, payload) {
            commit("updateUserField", payload);
            dispatch("saveUserDataToLocalStorage"); // Save user data after each update
        },
        // Action to reset the user state
        resetUserState({ commit, dispatch }) {
            commit("resetUserState");
            dispatch("saveUserDataToLocalStorage"); // Save user data after resetting
        },
        // Action to submit the user registration
        async submitRegistration({ state }) {
            try {
                // Implement your logic to send the registration data to the server
                // You can use state.user to access the user data
                const savedUserData = JSON.parse(
                    localStorage.getItem(localStorageKey)
                );
                const response = await axios.post(
                    "register-user",
                    savedUserData
                );

                // Handle success response
                console.log("Registration successful:", response.data);

                // You might want to perform additional actions here, like redirecting the user
            } catch (error) {
                // Handle error
                console.error("Error during registration:", error.message);
                // You might want to show an error message to the user or perform other actions
            }
        },
        // Action to save the user data to localStorage
        saveUserDataToLocalStorage({ state }) {
            localStorage.setItem(localStorageKey, JSON.stringify(state.user));
        },
        // Action to load the user data from localStorage
        loadUserDataFromLocalStorage({ commit }) {
            const savedUserData =
                JSON.parse(localStorage.getItem(localStorageKey)) || {};
            commit("updateUserField", { field: "user", value: savedUserData });
        },
    },
    modules: {},
};
