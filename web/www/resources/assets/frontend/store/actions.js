import helpers from "./../js/helpers";
import * as Validator from 'validatorjs';

export default {
  async init(context, payload) {
    const settings = helpers.getContext('settings');
    const customer = helpers.getContext('customer');
    const request = helpers.getContext('request');
    context.commit('setContextData', {
      settings,
      customer,
      request
    });
    await helpers.setLang(true);
  },
  
  async clearDataAction(context, modal_id) {
    $('#'+modal_id).modal('hide');
    context.commit('setModal', {});
    context.commit('setFormInput', {});
    context.commit('setLoader', {modal: null, button: null});
    context.commit('setErrorsAlert', {});
  },
  
  async modalShippingAction(context, payload) {
    context.commit('setLoader', { button: true });
    const data = {...context.state.formInput};
    const rules = {
      full_name: 'required|min:3|max:45',
      email: 'required|email',
      mobile_no: 'required|max:45'
    };
    let validation = new Validator(data, rules);
    if (validation.fails()) {
      // console.log(validation.errors.all());
      context.commit('setErrorsAlert',  {
        alert: null,
        errors: validation.errors.all()
      });
    } else {
      context.commit('setShoppingCart', { shipping_details: data });
      await context.dispatch('clearDataAction', _.get(context.state, 'modal.id'));
    }
    
    context.commit('setLoader', { button: false });
  },
  
  async getProducts(context, payload = {}) {
    _.set(payload, 'url', '/products');
    _.set(payload, 'params', {
      ..._.get(payload, 'params', {}),
      columns: _.get(payload, 'params.columns', null),
      sublist: _.get(payload, 'params.sublist', false),
      paginate: _.get(payload, 'params.paginate', false),
      limit: _.get(payload, 'params.limit', null),
    });
    const result = await helpers.getDataAction(payload);
    
    if (result && result.code === 200) {
      context.commit('setProducts', result.results);
    } else {
      context.commit('setErrorsAlert',  {
        alert: _.pick(result, ['code', 'message', 'status']),
        errors: {}
      });
    }
    return result.results;
  },
  
  async getCategories(context, payload = {}) {
    _.set(payload, 'url', '/categories');
    _.set(payload, 'params', {
      ..._.get(payload, 'params', {}),
      columns: _.get(payload, 'params.columns', null),
      sublist: _.get(payload, 'params.sublist', false),
      paginate: _.get(payload, 'params.paginate', false),
      limit: _.get(payload, 'params.limit', null),
    });
    const result = await helpers.getDataAction(payload);
    
    if (result && result.code === 200) {
      context.commit('setCategories', result.results);
    } else {
      context.commit('setErrorsAlert',  {
        alert: _.pick(result, ['code', 'message', 'status']),
        errors: {}
      });
    }
    return result.results;
  },
  
  async getSearchProducts(context, payload = {}) {
    context.commit('setSearchProduct', {loader: true});
    _.set(payload, 'url', '/products');
    _.set(payload, 'params', {
      ..._.get(payload, 'params', {}),
      columns: _.get(payload, 'params.columns', null),
      sublist: _.get(payload, 'params.sublist', false),
      paginate: _.get(payload, 'params.paginate', false),
      limit: _.get(payload, 'params.limit', null),
    });
    const result = await helpers.getDataAction(payload);
    
    if (result && result.code === 200) {
      context.commit('setSearchProduct', {
        loader: false,
        data: _.get(result, 'results.results', []),
      });
    } else {
      context.commit('setErrorsAlert',  {
        alert: _.pick(result, ['code', 'message', 'status']),
        errors: {}
      });
      context.commit('setSearchProduct', {loader: false});
    }
    return result.results;
  },
  
  async addItemToCart(context, payload = {}) {
    const items = _.get(context.state.shoppingCart, 'items', []);
    const hasItemIndex = _.findIndex(items, i => i.product_id === payload.product_id && i.item_lock === false);
    if (hasItemIndex > -1) {
      const item = await helpers.updateOrderItem(_.get(items, hasItemIndex, null), 1);
      if (item) {
        _.set(items, hasItemIndex, item);
        context.commit('setShoppingCart', {items});
      }
    } else {
      const requestPayload = {};
      _.set(requestPayload, 'url', '/products/' + payload.product_id);
      const result = await helpers.getDataAction(requestPayload);
  
      if (result && result.code === 200) {
        const product = _.get(result.results, 'results', {});
        const item = await helpers.makeOrderItem(product);
        if (item) {
          items.push(item);
          context.commit('setShoppingCart', {items});
        }
      }
      context.commit('setErrorsAlert', {
        alert: {
          ..._.pick(result, ['code', 'message', 'status']),
          message: helpers.getLang('frontend.item_add_message')
        },
        errors: {}
      });
    }
  },
  
  async deleteItemToCart(context, payload) {
    if (_.get(context.state.shoppingCart, `items[${payload.index}]`)) {
      const items = _.get(context.state.shoppingCart, 'items');
      items.splice(payload.index, 1);
      context.commit('setShoppingCart', {items});
      // context.commit('setErrorsAlert', {
      //   alert: {
      //     code: 200,
      //     status: 'success',
      //     message: helpers.getLang('frontend.item_add_message')
      //   },
      //   errors: {}
      // });
    }
  },
  
  async updateItemToCart(context, payload) {
    if (_.get(context.state.shoppingCart, `items[${payload.index}]`)) {
      const items = _.get(context.state.shoppingCart, 'items');
      let item = _.get(items, payload.index);
      item = await helpers.updateOrderItem(item, +payload.qty, true);
      if (item) {
        _.set(items, payload.index, item);
        context.commit('setShoppingCart', {items});
      }
    }
  },
  
  async placeOrder(context, payload) {
    context.commit('setLoader', { button: true });
    const requestPayload = {
      url: '/orders',
      method: 'POST',
      data: {
        ...context.state.shoppingCart,
        ...payload,
        source: 'online',
        order_source: 'online',
      },
    };

    const result = await helpers.postDataAction(requestPayload);
  
    if (result && result.code === 200) {
      context.commit('setShoppingCart', {
        shipping_details: {},
        items: [],
      });
    }
    
    context.commit('setErrorsAlert', {
      alert: _.pick(result, ['code', 'message', 'status']),
      errors: {}
    });
    context.commit('setLoader', { button: false });
  },
  
  async getOrders(context, payload = {}) {
    _.set(payload, 'url', '/orders');
    _.set(payload, 'params', {
      ..._.get(payload, 'params', {}),
      columns: _.get(payload, 'params.columns', null),
      sublist: _.get(payload, 'params.sublist', false),
      paginate: _.get(payload, 'params.paginate', true),
    });
    
    const result = await helpers.getDataAction(payload);
    
    if (result && result.code === 200) {
      context.commit('setOrders', result.results);
    } else {
      context.commit('setErrorsAlert',  {
        alert: _.pick(result, ['code', 'message', 'status']),
        errors: {}
      });
    }
    return result.results;
  },
  
  async getOrder(context, payload = {}) {
    _.set(payload, 'url', '/orders/'+payload.id);
    _.set(payload, 'params', {
      ..._.get(payload, 'params', {}),
      sublist: _.get(payload, 'params.sublist', true),
    });
    
    const result = await helpers.getDataAction(payload);
    
    if (result && result.code === 200) {
      context.commit('setOrder', result.results);
    } else {
      context.commit('setErrorsAlert',  {
        alert: _.pick(result, ['code', 'message', 'status']),
        errors: {}
      });
    }
    return result.results;
  },
  
  
};