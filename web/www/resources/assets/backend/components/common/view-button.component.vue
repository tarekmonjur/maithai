<template>
    <a v-if="buttons.view"
       :href="buttons.view.type === 'link' ? buttons.view.link+'/'+id : 'javascript:void(0)'"
       :data-toggle="buttons.view.type"
       :data-target="buttons.view.type === 'modal'? '#'+buttons.view.modal_id : false"
       v-on:click.prevent="buttonAction()">
        <img :src="this.asset('/img/seo.png')" alt="View">
    </a>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "view-button.component",
    props: ['id', 'action'],
    computed: {
        ...mapGetters([
            'buttons',
            'viewTitle',
        ])
    },
    methods: {
        buttonAction() {
            const button = _.get(this.buttons, 'view', null);

            if (_.get(button, 'type') === 'modal') {
                this.$store.dispatch('viewButtonAction', {
                    id: this.id,
                    modal: {
                        id: _.get(button, 'modal_id', null),
                        title: this.viewTitle,
                        button: null,
                    }
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
