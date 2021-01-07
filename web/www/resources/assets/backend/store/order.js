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
    },
    mutations: {
        ...mutations,
    }
}