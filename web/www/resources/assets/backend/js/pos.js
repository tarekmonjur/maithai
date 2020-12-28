require('./bootstrap');
import helpers from './helpers';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Select2 from 'vue3-select2-component';
import MainContentComponent from './../components/pos/pos.component';
import posStore from './../store/pos';

const store = Vuex.createStore(posStore);
const app = Vue.createApp(MainContentComponent, {helpers});
app.component('Select2', Select2)
// app.use(window.devtools);
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
    denyButtonColor: '#41b843',
};
app.use(VueSweetalert2, options);
app.mixin({
    methods: {
        ...helpers,
    }
});
app.use(store);
app.mount('#main_content');


