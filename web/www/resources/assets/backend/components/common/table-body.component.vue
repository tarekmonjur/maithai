<template>
    <div>
         <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th v-for="column in tableColumns" :width="column.width">{{column.name}}</th>
                </tr>
            </thead>
            <tbody>
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
        name: "tableBodyComponent",
        computed: {
            ...mapGetters([
                'tableColumns',
            ]),
        },
    }
</script>

<style scoped>

</style>
