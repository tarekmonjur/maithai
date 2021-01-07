import helpers from "../js/helpers";
import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';

const defaultInput = {
  type: 'sales',
  source: 'pos',
  payment_type: 'none',
  customer_id: -1,
  shipping_details: {},
};

export default {
    state: {
        url: '/orders',
        lang_key: 'pos',
        ...state,
        formInput: defaultInput,
        shippingDetails: {},
        print_bill: false,
        loading_list: {button: false},
        loading_item: {button: false},
        loading_order: {
            customer: false,
            coupon: false,
            save: false,
            complete: false,
            clear: false,
            btn_disabled: false,
            print_bill: false,
        },
        products: {},
        customers: {},
        tables: {},
    },
    getters: {
        ...getters,
        pageInfo: () => '',
        products(state) {
            return _.get(state.products, 'results', []) || [];
        },
        customers(state) {
            return _.get(state.customers, 'results', []) || [];
        },
        tables(state) {
          return _.get(state.tables, 'results', []) || [];
        },
        categories(state) {
            return _.get(state.formData, 'categories.results', []) || [];
        },
        subCategories(state) {
            return _.get(state.formData, 'sub_categories.results', []) || [];
        },
        totalSubTotal(state){
            return state.formInput.items ?
              state.formInput.items.reduce((sum, item) => sum + +item.sub_total, 0) : 0;
        },
    },
    actions: {
        ...actions,
        clearDataAction(context, modal_id) {
          $('#'+modal_id).modal('hide');
          context.commit('setModal', {});
          context.commit('setLoading', {modal: null, button: null});
        },
        async init(context) {
            if (_.get(window, '_context.request.id')) {
                context.dispatch('editOrderAction', { id: _.get(window, '_context.request.id',0) });
            }
            await helpers.setLang(true);
        },
        initList(context) {
            context.dispatch('getListData');
            context.dispatch('getCategories');
        },
        async initItem(context) {
            context.commit('setLoadingItem', {button: true});
            await actions.getProducts(context, {params: {columns: 'id,name,code,barcode'}});
            context.commit('setLoadingItem', {button: false});
        },
        async initOrder(context) {
            context.commit('setLoadingOrder', {customer: true});
            await actions.getCustomers(context);
            await actions.getTables(context);
            context.commit('setLoadingOrder', {customer: false});
        },
        async getCategories(context, payload) {
            context.commit('setLoadingList', {button: true});
            await actions.getCategories(context, payload);
            context.commit('setLoadingList', {button: false});
        },
        async getSubCategories(context, payload) {
            context.commit('setLoadingList', {button: true});
            await actions.getSubCategories(context, payload);
            context.commit('setLoadingList', {button: false});
        },
        async getListData(context, payload = {}) {
            context.commit('setLoadingList', {button: true});
            _.set(payload, 'params', {
                ..._.get(payload, 'params', {}),
                sublist: false,
                columns: 'id,name,code,barcode,image,original_price,regular_price,special_price'
            });
            if (_.isEmpty(_.get(payload, 'url'))) {
                _.set(payload, 'url', '/products');
            }
            await actions.getListData(context, payload)
            context.commit('setLoadingList', {button: false});
        },
        async editOrderAction(context, payload) {
            const id = _.get(payload, 'id');
            if (id) {
                // context.commit('setLoadingItem', {button: true});
                // context.commit('setLoadingOrder', {customer: true});
                const requestPayload = {};
                _.set(requestPayload, 'url', context.state.url+'/'+id);
                _.set(requestPayload, 'params', {
                    sublist: true,
                });
                const result = await helpers.getDataAction(requestPayload);
    
                if (result && result.code === 200) {
                    const order = _.get(result.results, 'results', {});
                    _.set(order, 'items', _.get(order, 'order_details', []));
                    _.unset(order, 'order_details');
                    context.commit('setShippingDetails', {..._.get(order, 'shipping_details', {})});
                    context.commit('setFormInput', {...order});
                } else {
                    context.commit('setErrorsAlert',  {
                        alert: _.pick(result, ['code', 'message', 'status']),
                        errors: {}
                    });
                }
                // context.commit('setLoadingItem', {button: false});
                // context.commit('setLoadingOrder', {customer: false});
            }
        },
        async addOrderItem(context, payload) {
            context.commit('setLoadingItem', {button: true});
            context.commit('setPrintBill', false);
            const items = _.get(context.state.formInput, 'items', []);
            const hasItemIndex = _.findIndex(items, i => i.product_id === payload.product_id && i.item_lock === false);
            if (hasItemIndex > -1) {
                const item = await helpers.updateOrderItem(_.get(items, hasItemIndex, null), 1);
                if (item) {
                    _.set(items, hasItemIndex, item);
                    context.commit('setFormInput', {items});
                }
            } else {
                console.log({hasItemIndex});
                const requestPayload = {};
                _.set(requestPayload, 'url', '/products/' + payload.product_id);
                const result = await helpers.getDataAction(requestPayload);
    
                if (result && result.code === 200) {
                    context.commit('setFilterData', {product_id: null});
                    const product = _.get(result.results, 'results', {});
                    const item = await helpers.makeOrderItem(product);
                    if (item) {
                        items.push(item);
                        context.commit('setFormInput', {items});
                    }
                } else {
                    context.commit('setErrorsAlert', {
                        alert: _.pick(result, ['code', 'message', 'status']),
                        errors: {}
                    });
                }
            }
            context.commit('setLoadingItem', {button: false});
        },
        async saveOrderAction(context, payload) {
            context.commit('setLoadingOrder', {[payload.button_action]: true, btn_disabled: true});
            const requestPayload = {
                url: context.state.url,
                method: 'POST',
                data: {
                    ...context.state.formInput,
                    order_status: payload.order_status,
                    order_source: 'pos',
                },
            };
    
            if (_.get(payload, 'id', null)) {
                requestPayload.data._method = 'PUT';
                requestPayload.url = requestPayload.url+'/'+_.get(payload, 'id', 0);
            }
    
            const result = await helpers.postDataAction(requestPayload);
            
            if (result && result.code === 200) {
                context.commit('setErrorsAlert', {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: {}
                });
                context.commit('setFormInput', _.get(result, 'results'));
                context.commit('setShippingDetails', _.get(result, 'results.shipping_details', {}) || {});
                context.commit('setPrintBill', true);
            } else {
                context.commit('setErrorsAlert', {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: result.results
                });
            }
            context.commit('setLoadingOrder', {[payload.button_action]: false, btn_disabled: false});
        },
        async printBillAction(context, payload) {
          if (payload.id) {
            await context.dispatch('viewButtonAction', payload);
          }
          context.commit('setPrintBill', false);
          context.commit('setLoadingOrder', {print_bill: false, btn_disabled: false});
        },
        async modalButtonAction(context, payload) {
          context.commit('setLoading', {button: true});
          const requestPayload = {
            url: context.state.url,
            method: 'GET',
          };
          const modal_id = _.get(context.state.modal, 'id', '');
          const add_modal_id = _.get(context.state.buttons, 'add.modal_id', '');
          const edit_modal_id = _.get(context.state.buttons, 'edit.modal_id', '');
          
          if (modal_id === 'shipping') {
            console.log({shipping_details: {...context.state.shippingDetails}});
            context.commit('setFormInput', {shipping_details: {...context.state.shippingDetails}});
            await context.dispatch('clearDataAction', modal_id);
          }
          context.commit('setLoading', {button: false});
        },
    },
    mutations: {
        ...mutations,
        setLoadingList(state, loading) {
            state.loading_list = {
                ...state.loading_list,
                ...loading,
            };
        },
        setLoadingItem(state, loading) {
            state.loading_item = {
                ...state.loading_item,
                ...loading,
            };
        },
        setLoadingOrder(state, loading) {
            state.loading_order = {
                ...state.loading_order,
                ...loading,
            };
        },
        setPrintBill(state, payload) {
            state.print_bill = payload;
        },
        clearOrder(state, payload) {
          state.formInput = defaultInput;
          state.print_bill = false;
        },
        setShippingDetails(state, payload) {
          state.shippingDetails = payload;
        },
    }
}
