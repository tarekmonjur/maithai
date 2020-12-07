import helpers from "../js/helpers";

export default {
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
        context.commit('setFormData', {});
        context.commit('setFormInput', {});
        context.commit('setErrorsAlert', {});
    },
}
