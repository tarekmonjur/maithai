import helpers from "../js/helpers";
import state from "./state";
import getters from "./getters";
import actions from "./actions";
import mutations from "./mutations";

export default {
  state: {
    ...state,
    defaultProductParams: {
      is_active: 1,
      is_package: 0,
      paginate: true,
      sublist: true,
    },
  },
  getters: {
    ...getters,
    getPages: state => state.products.metadata ? helpers.getPages(state.products.metadata) : null,
    nextPageUrl: state => state.products.metadata ? state.products.metadata.next_page_url : '',
    previousPageUrl: state => state.products.metadata ? state.products.metadata.prev_page_url : '',
    nextPage: state => helpers.getLang(`pagination.next`),
    previousPage: state => helpers.getLang(`pagination.previous`),
  },
  actions: {
    ...actions,
    async getProducts(context, payload) {
      _.set(payload, 'params', {
        ...context.state.defaultProductParams,
        ...context.state.filters,
        ..._.get(payload, 'params', {}),
      });
      await actions.getProducts(context, payload);
    },
    async paginationAction(context, payload) {
      await context.dispatch('getProducts', payload);
    }
  },
  mutations: {
    ...mutations,
  }
}
