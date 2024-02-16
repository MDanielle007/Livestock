import { createStore } from "vuex";
import registrationModule from "./modules/registrationModule";

const store = createStore({
    state: {
        pushNotifToken: ''
    },
    getters: {},
    mutations: {
        updatePushToken(state, value) {
            state.pushNotifToken = value;
        },
        // Mutation to reset the user state
        resetPushToken(state) {
            state.user = {};
        },
    },
    actions: {
        // Action to update a specific user field
        updatePushToken({ commit }, payload) {
            commit("updatePushToken", payload);
        },
        // Action to reset the user state
        resetPushToken({ commit }) {
            commit("resetPushToken");
        },
    },
    modules: {
        registration: registrationModule,
    },
});

export default store;
