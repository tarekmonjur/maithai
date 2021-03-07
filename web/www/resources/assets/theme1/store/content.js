import helpers from "../js/helpers";
import state from "../store/state";
import getters from "../store/getters";
import actions from "../store/actions";
import mutations from "../store/mutations";

export default {
  state: {
    ...state,
  },
  getters: {
    ...getters,
  },
  actions: {
    ...actions,
  },
  mutations: {
    ...mutations,
  }
}
