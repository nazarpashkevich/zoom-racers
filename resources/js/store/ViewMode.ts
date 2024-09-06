import { ListViewMode } from "@/enums/ListViewMode";

export const viewMode = {
    state: () => ({
        mode: ListViewMode.Grid
    }),

    actions: {
        setMode({ commit }, mode: ListViewMode) {
            commit('setActiveMode', mode);
        }
    },

    mutations: {
        setActiveMode(state, mode: ListViewMode) {
            state.mode = mode;
        },
    },

    getters: {
        getActiveMode(state) {
            return state.mode;
        },
    }
};
