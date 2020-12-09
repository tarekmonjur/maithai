import helpers from "../js/helpers";
import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';

export default {
    state: {
        url: '/categories',
        lang_key: 'category',
        ...state,
        buttons: {
            add: {
              type: 'modal',
              modal_id: 'add',
              link: null,
            },
            edit: {
                type: 'modal',
                modal_id: 'edit',
                link: null,
            },
            view: {
                type: 'modal',
                modal_id: 'view',
                link: null,
            },
            delete: {
                type: 'modal',
                modal_id: 'delete',
                link: null,
            },
        },
    },
    getters: {
        ...getters,
    },
    actions: {
        ...actions,
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
                context.commit('setFormInput', result.results);
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
    }
}
