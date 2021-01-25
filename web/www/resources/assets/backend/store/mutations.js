export default {
    setContextData(state, payload) {
        state.settings = payload.settings;
        state.user = payload.user;
        state.request = payload.request;
    },
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
    setFormInput(state, payload) {
        state.formInput = {
            ...state.formInput,
            ...payload,
        };
    },
    clearFormData(state) {
        state.formData = {};
    },
    clearFormInput(state) {
        state.formInput = {};
    },
    setProducts(state, payload) {
        state.products = payload;
    },
    setCustomers(state, payload) {
        state.customers = payload;
    },
    setTables(state, payload) {
        state.tables = payload;
    },
}
