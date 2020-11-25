<template>
    <div class="d-flex">
        <div class="flex-fill">
            <span class="card-title">{{tableTitle}}</span>
        </div>
        <div class="flex-fill text-right">
            <a data-toggle="collapse" href="#tableFilter" role="button" aria-expanded="false" aria-controls="tableFilter">
                <img :src="this.asset('/img/filter.png')" alt="">
                &nbsp;
                {{filterButtonName}}
            </a>
            &nbsp;
            &nbsp;
            <a v-if="buttons.add"
               :href="buttons.add.type === 'link' ? buttons.add.link : 'javascript:void(0)'"
               :data-toggle="buttons.add.type"
               :data-target="buttons.add.type === 'modal'? '#'+buttons.add.modal_id : false"
               v-on:click.prevent="addButton()">
                <img :src="this.asset('/img/plus.png')" alt="">
                &nbsp;
                {{addButtonName}}
            </a>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapState} from 'vuex';

export default {
    name: "table-header.component",
    computed: {
        ...mapState([
            'buttons'
        ]),
        ...mapGetters([
            'tableTitle',
            'filterButtonName',
            'addButtonName',
        ]),
    },
    methods: {
        addButton() {
            const add = _.get(this.buttons, 'add', null);
            console.log(this.buttons.add);
            if (_.get(add, 'type') === 'modal') {
                this.$store.dispatch('addButton', _.get(add, 'modal_id', null));
            }
            else if (_.get(add, 'type') === 'link') {
                window.location.href = _.get(add, 'id_link', '');
            } else {
                console.log('button type not valid');
            }
        }
    }
}
</script>

<style scoped>

</style>
