<template>
    <div v-if="modal.id" class="modal fade" :id="modal.id" data-backdrop="static" data-keyboard="false" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" :class="modal.size || 'modal-lg'">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{modal.title}}</h5>
                    <button type="button" class="close" @click="clearData()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-gray-light">
                    <loading-component :loader="loading.modal" size="large">
                      <slot></slot>
                    </loading-component>
                </div>
                <div class="modal-footer" v-if="modal.button">
                    <button type="button" :disabled="loading.button || loading.modal" class="btn btn-theme" @click.prevent.enter="buttonAction()">
                        <loading-component :loader="loading.button">
                          {{modal.button}}
                        </loading-component>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';
import LoadingComponent from '../common/loading.component';

export default {
    name: "modal.component",
    props: ['id'],
    components: {LoadingComponent},
    computed: {
        ...mapState([
            'modal',
            'loading'
        ]),
    },
    methods: {
        buttonAction() {
            this.$store.dispatch('modalButtonAction');
        },
        clearData() {
            this.$store.dispatch('clearDataAction', this.modal.id);
        }
    },
    updated() {
        console.log('update modal..', this.modal);
    }
}
</script>

<style scoped>

</style>
