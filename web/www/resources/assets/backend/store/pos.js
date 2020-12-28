import helpers from "../js/helpers";
import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';

export default {
    state: {
        url: '/pos',
        lang_key: 'pos',
        ...state,
        loading_list: {button: false},
        loading_item: {button: false},
        loading_order: {
            customer: false,
            coupon: false,
            save: false,
            complete: false,
            clear: false,
        },
        products: {},
        customers: {},
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
        categories(state) {
            return _.get(state.formData, 'categories.results', []) || [];
        },
        subCategories(state) {
            return _.get(state.formData, 'sub_categories.results', []) || [];
        },
        totalSubTotal(state){
            return state.formInput.items ?
              state.formInput.items.reduce((sum, item) => sum + +item.sub_total, 0) : 0;
        }
    },
    actions: {
        ...actions,
        async init(context) {
            await helpers.setLang(true);
        },
        async initList(context) {
            await context.dispatch('getListData');
            await context.dispatch('getCategories');
        },
        async initItem(context) {
            context.commit('setLoadingItem', {button: true});
            await actions.getProducts(context);
            context.commit('setLoadingItem', {button: false});
        },
        async initOrder(context) {
            context.commit('setLoadingOrder', {customer: true});
            context.commit('setFormInput', {
                type: 'sales',
                source: 'pos',
                payment_type: 'card',
                customer_id: "1",
            });
            await actions.getCustomers(context);
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
        async addOrderItem(context, payload) {
            context.commit('setLoadingItem', {button: true});
            const items = _.get(context.state.formInput, 'items', []);
            const hasItemIndex = _.findIndex(items, i => i.product_id === payload.product_id && i.lock_item === false);
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
        
        
        async addButtonAction(context, payload) {
            context.commit('setModal', payload);
        },
        async editButtonAction(context, payload) {
            await context.dispatch('addButtonAction', payload.modal);
            context.commit('setLoading', {modal: true});
            const requestPayload = {};
            _.set(requestPayload, 'url', context.state.url+'/'+payload.id);
            _.set(requestPayload, 'params', {
                sublist: false,
            });
            const result = await helpers.getDataAction(requestPayload);

            if (result && result.code === 200) {
                
                context.commit('setFormInput', _.get(result.results, 'results', {}));
            } else {
                context.commit('setErrorsAlert',  {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: {}
                });
            }
            context.commit('setLoading', {modal: false});
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

            if (modal_id === add_modal_id || modal_id === edit_modal_id) {
                requestPayload.method = 'POST';
                requestPayload.data = context.state.formInput;
                requestPayload.headers = {'Content-Type': 'multipart/form-data'};

                if (modal_id === edit_modal_id) {
                    requestPayload.data._method = 'PUT';
                    requestPayload.url = requestPayload.url+'/'+_.get(context.state, 'formInput.id', 0);
                }
            }

            const result = await helpers.postDataAction(requestPayload);

            if (result && result.code === 200) {
                context.commit('setErrorsAlert', {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: {}
                });
                await context.dispatch('getListData');
                await context.dispatch('clearDataAction', modal_id);
            } else {
                context.commit('setErrorsAlert', {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: result.results
                });
            }
            context.commit('setLoading', {button: false});
        },
    },
    mutations: {
        ...mutations,
        setProducts(state, payload) {
            state.products = payload;
        },
        setCustomers(state, payload) {
            state.customers = payload;
        },
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
    }
}
