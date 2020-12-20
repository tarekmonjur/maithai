<template>
    <tr v-for="row in tableData">
        <td>{{row.id}}</td>
        <td>{{row.username}}</td>
        <td>{{row.first_name}}</td>
        <td>{{row.last_name}}</td>
        <td>{{row.email}}</td>
        <td>{{row.mobile_no}}</td>
        <td>
            <img :src="row.photo" alt="" width="60">
        </td>
        <td>{{row.gender}}</td>
        <td>{{row.referral_code}}</td>
        <td>{{this.isActive(row.is_membership)}}</td>
        <td>{{this.isActive(row.is_active)}}</td>
        <td>{{this.isActive(row.email_verified)}}</td>
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
