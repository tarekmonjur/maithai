<template>
     <table class="table table-head-fixed table-hover m-0">
        <thead>
            <tr>
                <th v-for="column in columns" :width="column.width">{{column.name}}</th>
            </tr>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "table-body.component",
    props: ['columns'],
}
</script>

<style scoped>

</style>
