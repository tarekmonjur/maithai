import helpers from "../js/helpers";
import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';

export default {
    state: {
        url: '/customers',
        lang_key: 'customer',
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
                sublist: true,
            });
            const result = await helpers.getDataAction(requestPayload);

            if (result && result.code === 200) {
                const results = {..._.get(result.results, 'results', {})};
                _.unset(results, 'details');
                _.unset(results, 'created_by');
                _.unset(results, 'updated_by');
                context.commit('setFormInput', {
                    ..._.get(result.results, 'results.details', {}),
                    details_id: _.get(result.results, 'results.details.id', {}),
                    ...results,
                });
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
                console.log(context.state.formInput);
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
