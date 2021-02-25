<template>
    <a v-if="buttons.edit"
       :href="buttons.edit.type === 'link' ? buttons.edit.link_href : 'javascript:void(0)'"
       :data-toggle="buttons.edit.type"
       :data-target="buttons.edit.type === 'modal'? '#'+buttons.edit.modal_id : false"
       v-on:click.prevent="buttonAction()">
        <img :src="this.asset('/img/pencil.png')" alt="Edit">
    </a>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "edit-button.component",
    props: ['id'],
    computed: {
        ...mapGetters([
            'buttons',
            'editButtonName',
            'updateButtonName',
        ])
    },
    methods: {
        buttonAction() {
            const button = _.get(this.buttons, 'edit', null);

            if (_.get(button, 'type') === 'modal') {
                this.$store.dispatch('editButtonAction', {
                    id: this.id,
                    modal: {
                        id: _.get(button, 'modal_id', null),
                        title: this.editButtonName,
                        button: this.updateButtonName,
                    }
                });
            }
            else if (_.get(button, 'type') === 'link') {
                window.location.href = _.get(button, 'link_href', '') +'/'+this.id;
            } else {
                console.log('button type not valid');
            }
        }
    }
}
</script>

<style scoped>

</style>
