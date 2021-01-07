import helpers from "../js/helpers";

export default {
    async init(context) {
        if (_.get(window, '_context.request.query')) {
            context.dispatch('filterButtonAction', _.get(window, '_context.request.query',{}));
        }
        await helpers.setLang(true);
        await context.dispatch('getListData');
    },

    async getListData(context, payload) {
        payload = _.isEmpty(payload) ? {} : payload;
        console.log(context.state.filterData);
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
        context.commit('setLoading', {filter: false});
    },

    async filterButtonAction(context, payload) {
        context.commit('setLoading', {filter: true});
        context.commit('setFilterData', payload);
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

    async clearDataAction(context, modal_id) {
        $('#'+modal_id).modal('hide');
        context.commit('setModal', {});
        context.commit('setLoading', {modal: null, button: null});
        context.commit('clearFormInput', {});
        context.commit('setErrorsAlert', {});
    },
    
    async getCustomers(context, payload = {}) {
        _.set(payload, 'url', '/customers');
        _.set(payload, 'params', {
            columns: _.get(payload, 'params.columns', null),
            sublist: _.get(payload, 'sublist', true),
            paginate: _.get(payload, 'paginate', false),
        });
        const result = await helpers.getDataAction(payload);
        
        if (result && result.code === 200) {
            context.commit('setCustomers', result.results);
        } else {
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
        }
        return result.results;
    },
    
    async getProducts(context, payload = {}) {
        _.set(payload, 'url', '/products');
        _.set(payload, 'params', {
            columns: _.get(payload, 'params.columns', null),
            sublist: _.get(payload, 'sublist', false),
            paginate: _.get(payload, 'paginate', false),
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
    
    async getTables(context, payload = {}) {
        _.set(payload, 'url', '/tables');
        _.set(payload, 'params', {
            columns: _.get(payload, 'params.columns', null),
            sublist: _.get(payload, 'sublist', false),
            paginate: _.get(payload, 'paginate', false),
        });
        const result = await helpers.getDataAction(payload);
        
        if (result && result.code === 200) {
            context.commit('setTables', result.results);
        } else {
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
        }
        return result.results;
    },

    async getCategories(context) {
        if (!_.isEmpty(_.get(context.state.formData, 'categories'))) {
            return _.get(context.state.formData, 'categories');
        }

        const requestPayload = {};
        _.set(requestPayload, 'url', '/categories');
        _.set(requestPayload, 'params', {
            columns: 'id,name',
            sublist: false,
            paginate: false,
        });
        const result = await helpers.getDataAction(requestPayload);

        if (result && result.code === 200) {
            context.commit('setFormData', {
                categories: result.results,
            });
        } else {
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
        }
        return result.results;
    },

    async getSubCategories(context, payload) {
        const requestPayload = {};
        _.set(requestPayload, 'url', `/categories/${payload.id}/subcategories`);
        _.set(requestPayload, 'params', {
            columns: 'id,name',
            sublist: false,
            paginate: false,
        });
        const result = await helpers.getDataAction(requestPayload);

        if (result && result.code === 200) {
            context.commit('setFormData', {
                sub_categories: result.results,
            });
        } else {
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
        }
        return result.results;
    },

    async getUnits(context) {
        if (!_.isEmpty(_.get(context.state.formData, 'units'))) {
            return _.get(context.state.formData, 'units');
        }

        const requestPayload = {};
        _.set(requestPayload, 'url', '/units');
        _.set(requestPayload, 'params', {
            columns: 'id,name',
            sublist: false,
            paginate: false,
        });
        const result = await helpers.getDataAction(requestPayload);

        if (result && result.code === 200) {
            context.commit('setFormData', {
                units: result.results,
            });
        } else {
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
        }
        return result.results;
    },

    async getVariants(context) {
        if (!_.isEmpty(_.get(context.state.formData, 'variants'))) {
            return _.get(context.state.formData, 'variants');
        }

        const requestPayload = {};
        _.set(requestPayload, 'url', '/variants');
        _.set(requestPayload, 'params', {
            columns: 'id,name',
            sublist: false,
            paginate: false,
        });
        const result = await helpers.getDataAction(requestPayload);

        if (result && result.code === 200) {
            context.commit('setFormData', {
                variants: result.results,
            });
        } else {
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
        }
        return result.results;
    },

    async getSkus(context) {
        if (!_.isEmpty(_.get(context.state.formData, 'skus'))) {
            return _.get(context.state.formData, 'skus');
        }

        const requestPayload = {};
        _.set(requestPayload, 'url', '/skus');
        _.set(requestPayload, 'params', {
            columns: 'id,name',
            sublist: false,
            paginate: false,
        });
        const result = await helpers.getDataAction(requestPayload);

        if (result && result.code === 200) {
            context.commit('setFormData', {
                skus: result.results,
            });
        } else {
            context.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
        }
        return result.results;
    },
}
