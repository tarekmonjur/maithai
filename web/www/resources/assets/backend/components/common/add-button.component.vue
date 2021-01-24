<template>
    <a v-if="buttons.add"
       :href="buttons.add.type === 'link' ? buttons.add.link_href : 'javascript:void(0)'"
       :data-toggle="buttons.add.type"
       :data-target="buttons.add.type === 'modal'? '#'+buttons.add.modal_id : false"
       v-on:click.prevent="buttonAction()">
        <img :src="this.asset('/img/plus.png')" :alt="addButtonName">
        &nbsp;
        {{addButtonName}}
    </a>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "add-button.component",
    computed: {
        ...mapGetters([
            'buttons',
            'addButtonName',
            'saveButtonName',
        ]),
    },
    methods: {
        buttonAction() {
            const button = _.get(this.buttons, 'add', null);

            if (_.get(button, 'type') === 'modal') {
                this.$store.dispatch('addButtonAction', {
                    id: _.get(button, 'modal_id', null),
                    title: this.addButtonName,
                    button: this.saveButtonName
                });
            }
            else if (_.get(button, 'type') === 'link') {
                window.location.href = _.get(button, 'link_href', '');
            } else {
                console.log('button type not valid');
            }
        }
    }
}
</script>

<style scoped>

</style>
