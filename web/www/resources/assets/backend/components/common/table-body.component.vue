<template>
     <table class="table table-head-fixed table-bordered table-hover">
        <thead class="bg-gradient-gray">
            <tr>
                <th v-for="column in tableColumns" :width="column.width">{{column.name}}</th>
            </tr>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</template>

<script>
import {mapGetters} from "vuex";

export default {
        name: "table-body.component",
        computed: {
            ...mapGetters([
                'tableColumns',
            ]),
        },
    }
</script>

<style scoped>

</style>
