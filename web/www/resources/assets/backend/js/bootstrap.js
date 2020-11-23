window.Vue = require('vue');
window.Vuex = require('vuex');
window._ = require('lodash');
window.$ = window.jQuery = require('./jquery.min');
window.baseURL = window._baseURL || '';
window.assetURL = window._assetURL || '';
window.apiPrefix = '/api'

window.axios = require('axios');
window.axios.defaults.baseURL = baseURL+apiPrefix;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('access_token');
window.axios.defaults.validateStatus = function (status) { return status < 599; };

(function(){
    window.heights = {};
    $(function(){
        const heights = {
            scroll: $(document).height(),
            window: $(window).height(),
            body: $('body').height(),
            header: $('.main-header').outerHeight(),
            footer: $('.main-footer').outerHeight(),
            content: function () {
                return this.body - this.header - this.footer - 30;
            }
        };
        $('.card-body').css('max-height', heights.content());
        OverlayScrollbars($('.card-body'), { height: heights.content()});
        // console.log({heights}, heights.content());
        window.heights = heights;
    });
})();



// let token = document.head.querySelector('meta[name="csrf-token"]');
//
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }




