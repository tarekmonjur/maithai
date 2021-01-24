<template>
    <tr v-for="row in tableData">
        <td>{{row.id}}</td>
        <td>{{row.name}}</td>
        <td>{{row.sort}}</td>
        <td>{{row.products_count}}</td>
        <td>{{row.sub_categories_count}}</td>
        <td>{{row.slug}}</td>
        <td>{{this.isActive(row.is_active)}}</td>
        <td>
            <img :src="row.image" alt="" width="60">
        </td>
        <td v-html="this.created(row)"></td>
        <td v-html="this.updated(row)"></td>
        <td>
            <div class="d-flex actions">
                <div class="flex-fill">
                    <edit-button-component :id="row.id"></edit-button-component>
                </div>
                <div class="flex-fill">
                    <view-button-component :id="row.id"></view-button-component>
                </div>
                <div class="flex-fill">
                    <delete-button-component :id="row.id"></delete-button-component>
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
import {mapGetters} from "vuex";
import EditButtonComponent from "../common/edit-button.component";
import ViewButtonComponent from "../common/view-button.component";
import DeleteButtonComponent from "../common/delete-button.component";

export default {
    name: "list.component",
    components: {
        EditButtonComponent,
        ViewButtonComponent,
        DeleteButtonComponent,
    },
    computed: {
        ...mapGetters(['tableData']),
    }
}
</script>

<style scoped>

</style>
