require('./bootstrap');
import helpers from './helpers';
import MainContentComponent from './../components/category/category.component';
import categoryStore from './../store/category';

const store = Vuex.createStore(categoryStore);
const app = Vue.createApp(MainContentComponent, {helpers});
// app.use(window.devtools);
app.mixin({
    methods: {
        ...helpers
    }
});
app.use(store);
app.mount('#main_content');


