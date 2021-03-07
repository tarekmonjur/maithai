require('./bootstrap');
import helpers from './helpers';
import MainComponent from './../components/payment-alert.component';

const app = Vue.createApp(MainComponent);
app.mixin({
  methods: {
    ...helpers,
  }
});
app.mount('#app');