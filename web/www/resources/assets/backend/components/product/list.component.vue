<template>
    <tr v-for="row in tableData">
        <td>{{row.id}}</td>
        <td>{{row.name}}</td>
        <td>{{row.code}}</td>
        <td>{{row.barcode}}</td>
        <td>{{row.sort}}</td>
        <td><img :src="row.image" alt="" width="60"></td>
        <td>{{row.unit && row.unit.name}}</td>
        <td>{{row.category && row.category.name}}</td>
        <td>{{row.sub_category && row.sub_category.name}}</td>
        <td>{{row.regular_price}}</td>
        <td>{{row.special_price}}</td>
        <td>{{row.vat_percent}}</td>
        <td>{{this.isStock(row.is_stock)}} ({{ row.stock || 0}})</td>
        <td>{{this.isActive(row.is_active)}}</td>
        <td>{{this.isPackage(row.is_package)}}</td>
        <td>{{this.isNew(row.is_new)}}</td>
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
    },
    methods: {
        action() {
            console.log('view action');
        }
    }
}
</script>

<style scoped>

</style>
