import helpers from "../js/helpers";

export default {
    state: {
        url: '/categories',
        listData: {},
        columns: {},
        filters: {},
        showData: {},
        filterData: {},
        formData: {},
        formInput: {},
        errors: {},
        modal: {},
        alert: {},
        loading: {},
        lang_key: 'category',
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
        defaultName: state => helpers.getLang(`${state.lang_key}.default`),
        filterButtonName: state => helpers.getLang(`${state.lang_key}.filter`),
        addButtonName: state => helpers.getLang(`${state.lang_key}.add`),
        editButtonName: state => helpers.getLang(`${state.lang_key}.edit`),
        saveButtonName: state => helpers.getLang(`${state.lang_key}.save`),
        submitButtonName: state => helpers.getLang(`${state.lang_key}.submit`),
        updateButtonName: state => helpers.getLang(`${state.lang_key}.update`),
        listTitle: state => state.listData.title || helpers.getLang(`${state.lang_key}.list`),
        viewTitle: state => state.showData.title || helpers.getLang(`${state.lang_key}.view`),
        nextPage: state => helpers.getLang(`pagination.next`),
        previousPage: state => helpers.getLang(`pagination.previous`),
        pageInfo: state => helpers.getLang(`pagination.info`, {
            'record': state.listData.results ? state.listData.results.length : 0,
            'total': state.listData.metadata ? state.listData.metadata.total : 0,
        }),
        fieldName: state => helpers.getLang(`${state.lang_key}.field_name`),
        fieldValue: state => helpers.getLang(`${state.lang_key}.field_value`),

        tableColumns: state => JSON.parse(window._columns || state.columns),
        tableData: state => state.listData.results || [],
        showData: state => state.showData.results || {},
        nextPageUrl: state => state.listData.metadata ? state.listData.metadata.next_page_url : '',
        previousPageUrl: state => state.listData.metadata ? state.listData.metadata.prev_page_url : '',
        getPages: state => state.listData.metadata ? helpers.getPages(state.listData.metadata) : {},
        buttons: state => state.buttons || {},
        filters: state => JSON.parse(window._filters || state.filters),
    },
    actions: {
        async init(context) {
            await helpers.setLang(true);
            await context.dispatch('getListData');
        },
        async getListData(context, payload) {
            payload = _.isEmpty(payload) ? {} : payload;
            _.set(payload, 'params', {
                ...context.state.filterData,
                ..._.get(payload, 'params', {}),
            });

            if (_.isEmpty(_.get(payload, 'url'))) {
                _.set(payload, 'url', context.state.url);
            }

            const result = await helpers.getDataAction(payload);

            if (result && result.code === 200) {
                context.commit('setListData', result);
            } else {
                context.commit('setErrorsAlert',  {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: {}
                });
            }
        },
        async filterButtonAction(context, payload) {
            context.commit('setFilterData', payload);
        },
        async addButtonAction(context, payload) {
            context.commit('setModal', payload);
            context.commit('setLoading', {modal: true});
            const requestPayload = {};
            _.set(requestPayload, 'url', context.state.url);
            _.set(requestPayload, 'params', {
                columns: 'id,name',
                sublist: false,
                paginate: false,
            });
            let result = await helpers.getDataAction(requestPayload);

            if (result && result.code === 200) {
                context.commit('setFormData', {categories: result.results});
            } else {
                context.commit('setErrorsAlert',  {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: {}
                });
            }
            context.commit('setLoading', {modal: false});
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
        async viewButtonAction(context, payload) {
            context.commit('setLoading', {modal: true});
            context.commit('setModal', payload.modal);
            const requestPayload = {};
            _.set(requestPayload, 'url', context.state.url+'/'+payload.id);
            const result = await helpers.getDataAction(requestPayload);

            if (result && result.code === 200) {
                context.commit('setShowData', result);
            } else {
                context.commit('setErrorsAlert',  {
                    alert: _.pick(result, ['code', 'message', 'status']),
                    errors: {}
                });
            }
            context.commit('setLoading', {modal: false});
        },
        async deleteButtonAction(context, payload) {
            const requestPayload = {};
            _.set(requestPayload, 'url', context.state.url+'/'+payload.id);
            const result = await helpers.deleteDataAction(requestPayload);
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
            });
            if (result && result.code === 200) {
                await context.dispatch('getListData');
            }
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
        async clearDataAction(context, modal_id) {
            $('#'+modal_id).modal('hide');
            context.commit('setModal', {});
            context.commit('setFormData', {});
            context.commit('setFormInput', {});
            context.commit('setErrorsAlert', {});
        }
    },
    mutations: {
        setListData(state, data) {
            state.listData = _.get(data, 'results', {});
        },
        setShowData(state, data) {
            state.showData = _.get(data, 'results', {});
        },
        setErrorsAlert(state, payload) {
            state.alert = _.get(payload, 'alert', {});
            state.errors = _.get(payload, 'errors', {});
        },
        setModal(state, modal) {
            state.modal = modal;
        },
        setLoading(state, loading) {
            state.loading = {
                ...state.loading,
                ...loading,
            };
        },
        setFilterData(state, filters) {
            state.filterData = filters;
        },
        setFormData(state, payload) {
            state.formData = {
                ...state.formData,
                ...payload,
            };
        },
        setFormInput(state, data) {
            state.formInput = _.get(data, 'results', {});
        },
    }
}
