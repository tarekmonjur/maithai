export default {
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
  setFilters(state, payload) {
    state.filters = payload;
  },
};