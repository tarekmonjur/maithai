<template>
    <div class="d-flex">
        <div class="flex-fill">
            <span class="card-title">{{tableTitle}}</span>
        </div>
        <div class="flex-fill text-right">
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <img :src="this.asset('/img/filter.png')" alt="">
                &nbsp;
                {{filterButtonName}}
            </a>
            &nbsp;
            &nbsp;
            <a href="#" data-toggle="modal" data-target="#exampleModal">
                <img :src="this.asset('/img/plus.png')" alt="">
                &nbsp;
                {{addButtonName}}
            </a>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "table-header.component",
    computed: {
        ...mapGetters([
            'tableTitle',
            'filterButtonName',
            'addButtonName'
        ]),
    }
}
</script>

<style scoped>

</style>
