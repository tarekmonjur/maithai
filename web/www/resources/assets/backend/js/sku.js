require('./bootstrap');
import helpers from './helpers';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import MainContentComponent from './../components/sku/sku.component';
import SkuStore from './../store/sku';

const store = Vuex.createStore(SkuStore);
const app = Vue.createApp(MainContentComponent, {helpers});
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

