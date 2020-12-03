<template>
    <table id="table" class="table table-bordered table-hover table-sm">
        <thead class="bg-gradient-gray">
            <tr>
                <th>{{fieldName}}</th>
                <th>{{fieldValue}}</th>
            </tr>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "table-view.component",
    computed: {
        ...mapGetters([
            'fieldName',
            'fieldValue'
        ])
    }
}
</script>

<style scoped>

</style>
