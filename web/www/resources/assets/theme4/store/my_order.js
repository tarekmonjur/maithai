import helpers from "../js/helpers";
import state from "./state";
import getters from "./getters";
import actions from "./actions";
import mutations from "./mutations";

export default {
  state: {
    ...state,
    order: {},
    orders: {},
  },
  getters: {
    ...getters,
    ordersData(state) {
      return _.get(state.orders, 'results', []);
    },
    orderData(state) {
      return _.get(state.order, 'results', []);
    },
    orderColumns(){
      return [
        { name: helpers.getLang('order.sl'), width: 0, },
        { name: helpers.getLang('order.invoice_no'), width: 0, },
        { name: helpers.getLang('order.transaction_no'), width: 0, },
        { name: helpers.getLang('order.payment'), width: 0, },
        { name: helpers.getLang('order.status'), width: 0, },
        { name: helpers.getLang('order.items'), width: 0, },
        { name: helpers.getLang('order.qty'), width: 0, },
        { name: helpers.getLang('order.total_amount'), width: 0, },
        { name: helpers.getLang('order.paid_amount'), width: 0, },
        { name: helpers.getLang('order.due_amount'), width: 0, },
      ];
    },
    orderFilters: state => {
      const filters = (window._filters && JSON.parse(atob(window._filters))) ||  [];
      return _.compact(_.map(filters, i => i.frontend && i.frontend === true ? i : null));
    },
    pageInfo: state => helpers.getLang(`pagination.info`, {
      'record': state.orders.results ? state.orders.results.length : 0,
      'total': state.orders.metadata ? state.orders.metadata.total : 0,
    }),
    getPages: state => state.orders.metadata ? helpers.getPages(state.orders.metadata) : null,
    nextPageUrl: state => state.orders.metadata ? state.orders.metadata.next_page_url : '',
    previousPageUrl: state => state.orders.metadata ? state.orders.metadata.prev_page_url : '',
    nextPage: state => helpers.getLang(`pagination.next`),
    previousPage: state => helpers.getLang(`pagination.previous`),
  },
  actions: {
    ...actions,
    async filterButtonAction(context, payload) {
      await context.dispatch('getOrders', payload);
    },
    async paginationAction(context, payload) {
      await context.dispatch('getOrders', payload);
    },
    async showInvoiceAction(context, payload) {
      _.set(payload, 'modal.size', 'modal-xl');
      context.commit('setModal', payload.modal);
      context.commit('setLoader', {modal: true});
      await actions.getOrder(context, payload);
      context.commit('setLoader', {modal: false});
    },
    async modalInvoiceAction(context, payload) {
      context.commit('setLoader', {button: true});
      helpers.printInvoice('print_invoice');
      context.commit('setLoader', {button: false});
    }
  },
  mutations: {
    ...mutations,
    setOrders(state, payload) {
      state.orders = payload;
    },
    setOrder(state, payload) {
      state.order = payload;
    },
  }
}
