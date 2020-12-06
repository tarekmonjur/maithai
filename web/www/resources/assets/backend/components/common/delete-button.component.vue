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
                this.$swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$store.dispatch('deleteButtonAction', {
                            id: this.id,
                        });
                    } else {
                        this.$swal({
                            title: 'Cancelled',
                            text: 'Your data is safe.',
                            icon: 'error',
                            timer: 1500,
                            showConfirmButton: false,
                        })
                    }
                })

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
