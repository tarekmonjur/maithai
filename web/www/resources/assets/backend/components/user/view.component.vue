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
            <td>{{lang(`photo`)}}</td>
            <td><img :src="showData.details && showData.details.photo" alt="" width="60"></td>
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
            <td>{{lang(`designation`)}}</td>
            <td>{{showData.details && showData.details.designation}}</td>
        </tr>
        <tr>
            <td>{{lang(`salary`)}}</td>
            <td>{{showData.details && showData.details.salary}}</td>
        </tr>
        <tr>
            <td>{{lang(`user_type`)}}</td>
            <td>{{showData.details && showData.details.type && showData.details.name}}</td>
        </tr>
        <tr>
            <td>{{lang(`service_type`)}}</td>
            <td>{{showData.details && showData.details.service && showData.details.name}}</td>
        </tr>
        <tr>
            <td>{{lang(`user_status`)}}</td>
            <td>{{showData.details && showData.details.status && showData.details.name}}</td>
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
            <td>{{lang(`date_of_birth`)}}</td>
            <td>{{showData.details && showData.details.date_of_birth}}</td>
        </tr>
        <tr>
            <td>{{lang(`joining_date`)}}</td>
            <td>{{showData.details && showData.details.joining_date}}</td>
        </tr>
        <tr>
            <td>{{lang(`is_active`)}}</td>
            <td>{{this.isActive(showData.is_active)}}</td>
        </tr>
        <tr>
            <td>{{lang(`father_name`)}}</td>
            <td>{{showData.details && showData.details.f_name}}</td>
        </tr>
        <tr>
            <td>{{lang(`mother_name`)}}</td>
            <td>{{showData.details && showData.details.m_name}}</td>
        </tr>
        <tr>
            <td>{{lang(`present_address`)}}</td>
            <td>{{showData.details && showData.details.present_address}}</td>
        </tr>
        <tr>
            <td>{{lang(`permanent_address`)}}</td>
            <td>{{showData.details && showData.details.permanent_address}}</td>
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
