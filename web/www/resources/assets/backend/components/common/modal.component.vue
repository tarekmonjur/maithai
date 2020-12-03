<template>
    <div v-if="modal.id" class="modal fade" :id="modal.id" data-backdrop="static" data-keyboard="false" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">{{modal.title}}</h4>
                    <button type="button" class="close" @click="clearData()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer" v-if="modal.button">
                    <button type="button" class="btn btn-theme" @click.prevent.enter="buttonAction()">{{modal.button}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name: "modal.component",
    props: ['id'],
    computed: {
        ...mapState([
            'modal',
        ]),
    },
    methods: {
        buttonAction() {
            this.$store.dispatch('modalButtonAction');
        },
        clearData() {
            this.$store.dispatch('clearDataAction', this.modal.id);
        }
    }
}
</script>

<style scoped>

</style>
