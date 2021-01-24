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
    async signupAction(context, payload) {
      const request_payload = {
        url: '/customers',
        method: 'POST',
        data: _.get(payload, 'data', {}),
      }
      const result = await helpers.postDataAction(request_payload);
      if (_.get(result, 'code') === 200 && _.get(result, 'status') === 'success') {
        context.commit('setErrorsAlert',  {
          alert: _.pick(result, ['code', 'message', 'status']),
          errors: {},
        });
      } else {
        context.commit('setErrorsAlert',  {
          alert: _.pick(result, ['code', 'message', 'status']),
          errors: _.get(result, 'results', {}) || {},
        });
      }
    }
  },
  mutations: {
    ...mutations,
  }
}
