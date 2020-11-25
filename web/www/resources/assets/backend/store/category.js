import helpers from "../js/helpers";

const Methods = {
    async getDataAction(context, payload = {}) {
        const url = _.get(payload, 'url', null) || '/categories';
        const params = _.get(payload, 'params', null) || {};
        const result = await helpers.makeApiRequest(url, 'GET', {params});

        if (result && result.code === 200) {
            context.commit('setData', result);
        } else {
            context.commit('setAlert', result);
        }
    }
}

export default {
    state: {
        data: {
            title: '',
            columns: [],
            results: []
        },
        errors: {},
        formData: {},
        modal_id: null,
        alert: 'abd',
        loading: false,
        lang_key: 'category',
        buttons: {
            add: {
              type: 'modal',
              modal_id: 'add',
              link: null,
            },
            // add: null,
            edit: {
                type: 'modal',
                modal_id: 'edit',
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
        tableTitle: state => _.capitalize(state.data.title) || helpers.getLang(`${state.lang_key}.list`),
        tableColumns: state => state.data.columns || [],
        tableData: state => state.data.results || [],
        nextPage: state => helpers.getLang(`pagination.next`),
        nextPageUrl: state => state.data.next_page_url,
        previousPage: state => helpers.getLang(`pagination.previous`),
        previousPageUrl: state => state.data.prev_page_url,
        pageInfo: state => helpers.getLang(`pagination.info`, {
            'record': state.data.per_page,
            'total': state.data.total
        }),
        getPages: state => helpers.getPages(state.data),
    },
    actions: {
        async init(context) {
            await helpers.setLang(true);
            await Methods.getDataAction(context);
        },
        async getData(context, payload) {
            await Methods.getDataAction(context, payload);
        },
        async addButton(context, modal_id) {
            context.commit('setModalId', modal_id);
        }
    },
    mutations: {
        setData(state, data) {
            state.data = data.results;
        },
        setAlert(state, data) {
            state.alert = data;
        },
        setModalId(state, modal_id) {
            state.modal_id = modal_id;
        }
    }
}
