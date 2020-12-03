<template>
    <a v-if="buttons.delete"
       :href="buttons.delete.type === 'link' ? buttons.delete.link+'/'+id : 'javascript:void(0)'"
       :data-toggle="buttons.delete.type"
       :data-target="buttons.delete.type === 'modal'? '#'+buttons.delete.modal_id : false"
       v-on:click.prevent="buttonAction()">
        <img :src="this.asset('/img/trash.png')" alt="Delete">
    </a>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "delete-button.component",
    props: ['id'],
    computed: {
        ...mapGetters([
            'buttons'
        ])
    },
    methods: {
        buttonAction() {
            const button = _.get(this.buttons, 'delete', null);

            if (_.get(button, 'type') === 'modal') {
                this.$store.dispatch('deleteButtonAction', {
                    id: this.id,
                });
            }
            else if (_.get(button, 'type') === 'link') {
                window.location.href = _.get(button, 'id_link', '');
            } else {
                console.log('button type not valid');
            }
        }
    }
}
</script>

<style scoped>

</style>
