import { createStore } from "vuex";
import registrationModule from "./modules/registrationModule";

const store = createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        registration: registrationModule,
    },
});

export default store;
