export default {
  setContextData(state, payload) {
    state.settings = payload.settings;
    state.customer = payload.customer;
    state.request = payload.request;
  },
  setProducts(state, payload) {
    state.products = payload;
  },
  setCategories(state, payload) {
    state.categories = payload;
  },
  setSearchProduct(state, payload) {
    state.searchProduct = {
      ...state.searchProduct,
      ...payload,
    }
  },
  setShoppingCart(state, payload) {
    state.shoppingCart = {
      ...state.shoppingCart,
      ...payload
    }
    window.localStorage.setItem('shoppingCart', btoa(JSON.stringify(state.shoppingCart)));
  },
  setFormInput(state, payload) {
    state.formInput = payload;
  },
  setFilters(state, payload) {
    state.filters = payload;
  },
  setErrorsAlert(state, payload) {
    state.alert = _.get(payload, 'alert', null);
    state.errors = _.get(payload, 'errors', {});
  },
  setModal(state, modal) {
    state.modal = modal;
  },
  setLoader(state, payload) {
    state.loader = {
      ...state.loader,
      ...payload
    }
  },
};