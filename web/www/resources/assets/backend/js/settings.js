require('./bootstrap');
import helpers from './helpers';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
// import './../../../../public/backend/plugins/summernote/summernote-bs4.css';
// import './../../../../public/backend/plugins/summernote/summernote-bs4.min';
import MainContentComponent from './../components/settings/settings.component';
import Store from './../store/settings';

const store = Vuex.createStore(Store);
const app = Vue.createApp(MainContentComponent);
// app.use(window.devtools);
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};
app.use(VueSweetalert2, options);
app.mixin({
    methods: {
        ...helpers,
    }
});

app.use(store);
app.mount('#main_content');

(function(){
    $(document).ready(function() {
        $('.textarea').summernote();
    });
})();


