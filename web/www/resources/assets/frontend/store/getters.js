import helpers from "../js/helpers";

export default {
  getProducts(state) {
    return _.get(state, 'products.results', {});
  },
  getCategories(state) {
    return _.get(state, 'categories.results', {});
  },
  totalItems(state) {
    return state.shoppingCart.items.length || 0;
  },
  totalPrice(state){
    return state.shoppingCart.items ? helpers.getTotalPrice(state.shoppingCart): 0;
  },
  totalQty(state){
    return state.shoppingCart.items ? helpers.getTotalQty(state.shoppingCart) : 0;
  },
  totalDiscount(state){
    return state.shoppingCart.items ? helpers.getTotalDiscount(state.shoppingCart) : 0;
  },
  totalVat(state){
    return state.shoppingCart.items ? helpers.getTotalVat(state.shoppingCart) : 0;
  },
  totalSubTotal(state){
    return state.shoppingCart.items ? helpers.getTotalSubTotal(state.shoppingCart) : 0;
  },
  //
  vatAmount(state){
    return state.shoppingCart.items ? helpers.getVatAmount(state.shoppingCart) : 0;
  },
  totalAmount(state) {
    return state.shoppingCart.items ? helpers.getTotalAmount(state.shoppingCart) : 0;
  },
};