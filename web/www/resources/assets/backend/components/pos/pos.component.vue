<template>
  <div class="row">
    <list-component></list-component>
    <item-component></item-component>
    <order-component></order-component>
  </div>
  <modal-component>
    <invoice-component v-if="modal.id === 'invoice'"></invoice-component>
  </modal-component>
  <alert-component></alert-component>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
import AlertComponent from './../common/alert.component';
import ListComponent from './list.component';
import ItemComponent from './item.component';
import OrderComponent from './order.component';
import InvoiceComponent from './../common/invoice.component';
import ModalComponent from './../common/modal.component';

export default {
  name: "MainContentComponent",
  props: ['helpers'],
  components: {
    AlertComponent,
    ListComponent,
    ItemComponent,
    OrderComponent,
    InvoiceComponent,
    ModalComponent
  },
  computed: {
    ...mapState([
      'lang_key',
      'modal',
    ]),
  },
  created() {
    this.$store.dispatch('init');
  },
  mounted() {
    console.log('mounted', this.$store.state);
  },
  methods: {
    lang(key) {
      return this.getLang(`${this.lang_key}.${key}`);
    },
  },
  beforeUpdate() {
    console.log('before update');
  },
  updated() {
    console.log('after update');
  }
}
</script>

<style scoped>

</style>
