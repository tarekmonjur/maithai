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
        alert: null,
        loading: false,
        langKey: 'category',
    },
    getters: {
        tableTitle: state => _.capitalize(state.data.title) || helpers.getLang(`${state.langKey}.list`),
        tableColumns: state => state.data.columns || [],
        tableData: state => state.data.results || [],
        addButtonName: state => helpers.getLang(`${state.langKey}.add`),
        filterButtonName: state => helpers.getLang(`${state.langKey}.filter`),
        nextPage: state => helpers.getLang(`pagination.next`),
        previousPage: state => helpers.getLang(`pagination.previous`),
        pageInfo: state => helpers.getLang(`pagination.info`, {'record': 123, 'total': 657575}),
        pages: state => {
            const show_pages = [];
            let start_pages = 0;
            let end_pages = 0;
            let pages = 3;
            const total_page = state.data.last_page;
            const current_page = state.data.current_page;
            pages = total_page > pages ? pages : total_page;

            if (current_page <= 1 || pages === total_page) {
                start_pages = 1;
                end_pages = pages;
            }
            else if (current_page === pages) {
                start_pages = Math.ceil(pages / 2);
                end_pages = start_pages + pages - 1;
            }
            else {
                start_pages = current_page - ( current_page < pages ? pages - current_page : current_page - pages );
                start_pages = start_pages <= 0 ? 1 : start_pages;
                end_pages = start_pages + pages - 1;
            }

            if (start_pages <= 0) {
                start_pages = 1;
                end_pages = pages - 1;
            }

            if (end_pages > total_page) {
                end_pages = total_page;
                start_pages = end_pages - ( pages - 1);
            }

            for(start_pages; start_pages <= end_pages; start_pages++){
                show_pages.push(start_pages);
            }

            return show_pages;
        }
    },
    actions: {
        async init(context) {
            await helpers.setLang(true);
            await Methods.getDataAction(context);
        },
        async getData(context, payload) {
            await Methods.getDataAction(context, payload);
        }
    },
    mutations: {
        setData(state, data) {
            state.data = data.results;
        },
        setAlert(state, data) {
            state.alert = data;
        }
    }
}
