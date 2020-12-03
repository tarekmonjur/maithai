<template>
    <div class="d-flex">
        <div class="flex-fill">
            <span class="card-title">{{listTitle}}</span>
        </div>
        <div class="flex-fill text-right">
            <filter-button-component></filter-button-component>
            &nbsp;
            &nbsp;
            <add-button-component></add-button-component>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
import AddButtonComponent from './../common/add-button.component'
import FilterButtonComponent from './../common/filter-button.component';

export default {
    name: "table-header.component",
    components: {
        FilterButtonComponent,
        AddButtonComponent
    },
    computed: {
        ...mapGetters([
            'listTitle',
        ]),
    },
}
</script>

<style scoped>

</style>
