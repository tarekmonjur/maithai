require('./bootstrap');
import helpers from './helpers';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import MainContentComponent from './../components/variant/variant.component';
import variantStore from './../store/variant';

const store = Vuex.createStore(variantStore);
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


