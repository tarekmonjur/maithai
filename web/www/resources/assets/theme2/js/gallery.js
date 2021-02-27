require('./bootstrap');
import helpers from './helpers';
import MainComponent from './../components/gallery/gallery.component';
import Store from './../store/content';

const store = Vuex.createStore(Store);
const app = Vue.createApp(MainComponent);
app.mixin({
  methods: {
    ...helpers,
  }
});
app.use(store);
app.mount('#app');