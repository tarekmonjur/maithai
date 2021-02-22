import helpers from "../js/helpers";
import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';

export default {
    state: {
        url: '/orders',
        lang_key: 'order',
        ...state,
        buttons: {
            add: {
              type: 'link',
              modal_id: null,
              link_href:  window._posURL+'/orders/create',
            },
            edit: {
                type: 'link',
                modal_id: null,
                link_href: window._posURL+'/orders/edit',
            },
            view: {
                type: 'modal',
                modal_id: 'view',
                link_href: null,
            },
            delete: {
                type: 'modal',
                modal_id: 'delete',
                link_href: null,
            },
        },
    },
    getters: {
        ...getters,
    },
    actions: {
        ...actions,
        async viewButtonAction(context, payload) {
            _.set(payload, 'modal.size', 'modal-xl');
            await actions.viewButtonAction(context, payload);
        },
        async modalButtonAction(context, payload) {
            context.commit('setLoading', {button: true});
            const modal_id = _.get(context.state.modal, 'id', '');
            helpers.printInvoice('print_invoice');
            context.commit('setLoading', {button: false});
        },
        async updateOrderAction(context, payload) {
            const requestPayload = {
                url: context.state.url+'/'+payload.id+'/status',
                method: 'PUT',
                data: payload.data,
            };
            const result = await helpers.postDataAction(requestPayload);
    
            if (result && result.code === 200) {
                const orderListData = _.get(context.state, 'listData.results', []);
                const order_index = _.findIndex(orderListData, (item) => item.id === payload.id);
                const order = {
                    ..._.get(orderListData, order_index),
                    ...result.results
                };
                _.set(orderListData, order_index, order);
            }
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
        }
    },
    mutations: {
        ...mutations,
    }
}
