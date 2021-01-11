
export default {
  getProducts(state) {
    return _.get(state, 'products.results', {});
  },
  getCategories(state) {
    return _.get(state, 'categories.results', {});
  },
};