import helpers from "./../js/helpers";

export default {
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
};