<template>
    <table-view-component>
        <tr>
            <td>{{lang(`id`)}}</td>
            <td>{{showData.id}}</td>
        </tr>
        <tr>
            <td>{{lang(`username`)}}</td>
            <td>{{showData.username}}</td>
        </tr>
        <tr>
            <td>{{lang(`first_name`)}}</td>
            <td>{{showData.details && showData.details.first_name}}</td>
        </tr>
        <tr>
            <td>{{lang(`last_name`)}}</td>
            <td>{{showData.details && showData.details.last_name}}</td>
        </tr>
        <tr>
            <td>{{lang(`photo`)}}</td>
            <td><img :src="showData.details && showData.details.photo" alt="" width="60"></td>
        </tr>
        <tr>
            <td>{{lang(`email`)}}</td>
            <td>{{showData.details && showData.details.email}}</td>
        </tr>
        <tr>
            <td>{{lang(`mobile_no`)}}</td>
            <td>{{showData.details && showData.details.mobile_no}}</td>
        </tr>
        <tr>
            <td>{{lang(`gender`)}}</td>
            <td>{{showData.details && showData.details.gender}}</td>
        </tr>
        <tr>
            <td>{{lang(`referral_code`)}}</td>
            <td>{{showData.referral_code}}</td>
        </tr>
        <tr>
            <td>{{lang(`is_membership`)}}</td>
            <td>{{this.isMembership(showData.is_membership)}}</td>
        </tr>
        <tr>
            <td>{{lang(`is_active`)}}</td>
            <td>{{this.isActive(showData.is_active)}}</td>
        </tr>
        <tr>
            <td>{{lang(`email_verified`)}}</td>
            <td>{{this.isVerified(showData.email_verified)}}</td>
        </tr>
        <tr>
            <td>{{lang(`city`)}}</td>
            <td>{{showData.details && showData.details.city}}</td>
        </tr>
        <tr>
            <td>{{lang(`state`)}}</td>
            <td>{{showData.details && showData.details.state}}</td>
        </tr>
        <tr>
            <td>{{lang(`zip_code`)}}</td>
            <td>{{showData.details && showData.details.zip_code}}</td>
        </tr>
        <tr>
            <td>{{lang(`address`)}}</td>
            <td>{{showData.details && showData.details.address}}</td>
        </tr>
        <tr>
            <td>{{lang(`created`)}}</td>
            <td v-html="this.created(showData)"></td>
        </tr>
        <tr>
            <td>{{lang(`updated`)}}</td>
            <td v-html="this.updated(showData)"></td>
        </tr>
    </table-view-component>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
import TableViewComponent from "../common/table-view.component";

export default {
    name: "view.component",
    components: {
        TableViewComponent,
    },
    computed: {
        ...mapState([
            'lang_key',
        ]),
        ...mapGetters([
            'showData'
        ])
    },
    methods: {
        lang(key) {
            return this.getLang(`${this.lang_key}.${key}`);
        }
    }
}
</script>

<style scoped>
    tr td:first-child {font-weight: bold}
</style>
