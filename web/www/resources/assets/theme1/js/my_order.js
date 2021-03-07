require('./bootstrap');
import helpers from './helpers';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import MainComponent from './../components/my_order/my_order.component';
import Store from './../store/my_order';

const store = Vuex.createStore(Store);
const app = Vue.createApp(MainComponent);
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
app.mount('#app');