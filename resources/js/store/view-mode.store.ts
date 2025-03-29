import { ListViewModeEnum } from '@/enums/list-view-mode.enum';

export const viewModeStore = {
  state: () => ({
    mode: ListViewModeEnum.Grid,
  }),

  actions: {
    setMode({ commit }, mode: ListViewModeEnum) {
      commit('setActiveMode', mode);
    },
  },

  mutations: {
    setActiveMode(state, mode: ListViewModeEnum) {
      state.mode = mode;
    },
  },

  getters: {
    getActiveMode(state) {
      return state.mode;
    },
  },
};
