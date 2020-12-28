import helpers from "../js/helpers";

export default {
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

    tableColumns: state => (window._columns_config && JSON.parse(window._columns_config)) || state.columns_config,
    tableData: state => state.listData.results || [],
    showData: state => state.showData.results || {},
    nextPageUrl: state => state.listData.metadata ? state.listData.metadata.next_page_url : '',
    previousPageUrl: state => state.listData.metadata ? state.listData.metadata.prev_page_url : '',
    getPages: state => state.listData.metadata ? helpers.getPages(state.listData.metadata) : {},
    buttons: state => state.buttons || {},
    tableFilters: state => (window._filters_config && JSON.parse(window._filters_config)) ||  state.filters_config,
}
