window.Vue = require('vue');
window.Vuex = require('vuex');
window._ = require('lodash');

if (window.jQuery) {
    window.$ = window.jQuery;
} else if (window.$) {
    window.jQuery = window.$;
} else {
    window.$ = window.jQuery = require('./jquery.min');
}
// window.Popper = require('popper.js').default;

window._context = (window._context && JSON.parse(atob(window._context))) || [];
window.baseURL = window._baseURL || '';
window.asset = window._asset || '';
window.assetURL = window._assetURL || '';
window.apiPrefix = '/api'

window.axios = require('axios');
window.axios.defaults.baseURL = baseURL+apiPrefix;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('access_token');
window.axios.defaults.validateStatus = function (status) {
    return status < 599;
};

(function(){
    window.heights = {};
    $(function(){
    
    });
})();






