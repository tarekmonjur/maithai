<template>
    <div class="modal fade" :id="id" data-backdrop="static" data-keyboard="false" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">{{headerTitle()}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-theme">{{buttonTitle()}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapState} from 'vuex';

export default {
    name: "modal.component",
    props: ['id'],
    computed: {
        ...mapState([
            'buttons'
        ]),
        ...mapGetters([
            'defaultName',
            'addButtonName',
            'editButtonName',
            'saveButtonName',
            'submitButtonName',
            'updateButtonName',
        ]),
    },
    methods: {
        headerTitle() {
            const add = _.get(this.buttons, 'add', null);
            const edit = _.get(this.buttons, 'edit', null);
            if (add && add.modal_id === this.id) {
                return this.addButtonName;
            }
            else if (edit && edit.modal_id === this.id) {
                return this.editButtonName;
            } else {
                return this.defaultName;
            }
        },
        buttonTitle() {
            const add = _.get(this.buttons, 'add', null);
            const edit = _.get(this.buttons, 'edit', null);
            if (add && add.modal_id === this.id) {
                return this.saveButtonName;
            }
            else if (edit && edit.modal_id === this.id) {
                return this.updateButtonName;
            } else {
                return this.submitButtonName;
            }
        }
    }
}
</script>

<style scoped>

</style>
