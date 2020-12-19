import helpers from "../js/helpers";
import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';

export default {
    state: {
        url: '/products',
        lang_key: 'product',
        ...state,
        defaultInput: {
            is_stock: 1,
            is_package: 0,
            is_active: 1,
            is_new: 0,
        },
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
        categories(state) {
            return _.get(state.formData, 'categories.results', []) || [];
        },
        subCategories(state) {
            return _.get(state.formData, 'sub_categories.results', []) || [];
        },
        units(state) {
            return _.get(state.formData, 'units.results', []) || [];
        },
        variants(state) {
            return _.get(state.formData, 'variants.results', []) || [];
        },
        subVariants(state) {
            return _.get(state.formData, 'sub_variants', []) || [];
        },
        skus(state) {
            return _.get(state.formData, 'skus.results', []) || [];
        }
    },
    actions: {
        ...actions,
        async clearDataAction(context, payload) {
            await actions.clearDataAction(context, payload);
            context.commit('setFormData', {sub_variants: null});
        },

        async getSubVariants(context, payload) {
            const requestPayload = {};
            _.set(requestPayload, 'url', `/variants/${payload.id}/subvariants`);
            _.set(requestPayload, 'params', {
                columns: 'id,name',
                sublist: false,
                paginate: false,
            });
            const result = await helpers.getDataAction(requestPayload);

            if (result && result.code === 200) {
                const sub_variants = context.getters.subVariants;
                // sub_variants.splice(payload.index, 0, _.get(result, 'results.results', []));
                _.set(sub_variants, payload.index, _.get(result, 'results.results', []));
                context.commit('setFormData', {sub_variants});
            } else {
                context.commit('setErrorsAlert',  {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: {}
                });
            }
        },

        async viewButtonAction(context, payload) {
            _.set(payload, 'modal.size', 'modal-xl');
            await actions.viewButtonAction(context, payload);
        },

        async addButtonAction(context, payload) {
            context.commit('setModal', {
                ...payload,
                size: 'modal-xl',
            });
            context.commit('setLoading', {modal: true});
            context.commit('setFormInput', {...context.state.defaultInput});
            await context.dispatch('getUnits');
            await context.dispatch('getCategories');
            await context.dispatch('getVariants');
            await context.dispatch('getSkus');
            context.commit('setLoading', {modal: false});
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
                const product = _.get(result.results, 'results', {});
                context.commit('setFormInput', product);

                if (!_.isEmpty(_.get(product, 'variants', []))) {
                    _.forEach(product.variants, async (item, index) => {
                        await context.dispatch('getSubVariants', {id: item.variant_id, index});
                    });
                }

                if (_.get(product, 'category_id', 0) > 0) {
                    await context.dispatch('getSubCategories', {id: product.category_id});
                }
            } else {
                context.commit('setErrorsAlert',  {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: {}
                });
            }
            context.commit('setLoading', {modal: false});
        },

        async modalButtonAction(context, payload) {
            // context.commit('setLoading', {button: true});
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
