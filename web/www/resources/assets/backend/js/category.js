require('./bootstrap');
import helpers from './helpers';
import MainContentComponent from './../components/category.component';
import categoryStore from './../store/category';

const store = Vuex.createStore(categoryStore);
const app = Vue.createApp(MainContentComponent, {helpers});
app.mixin({
    methods: {
        ...helpers
    }
});
app.use(store);
app.mount('#main_content');
