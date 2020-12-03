<template>
    <table-view-component>
        <tr>
            <td>{{lang(`id`)}}</td>
            <td>{{showData.id}}</td>
        </tr>
        <tr>
            <td>{{lang(`name`)}}</td>
            <td>{{showData.name}}</td>
        </tr>
        <tr>
            <td>{{lang(`image`)}}</td>
            <td>{{showData.image}}</td>
        </tr>
        <tr>
            <td>{{lang(`slug`)}}</td>
            <td>{{showData.slug}}</td>
        </tr>
        <tr>
            <td>{{lang(`is_active`)}}</td>
            <td>{{this.isActive(showData.is_active)}}</td>
        </tr>
        <tr>
            <td>{{lang(`products_count`)}}</td>
            <td>{{showData.products_count}}</td>
        </tr>
        <tr>
            <td>{{lang(`sub_categories`)}} ({{showData.sub_categories_count}})</td>
            <td>
                <span v-for="category in showData.sub_categories">{{category.name}},&nbsp;</span>
            </td>
        </tr>
        <tr>
            <td>{{lang(`description`)}}</td>
            <td>{{showData.description}}</td>
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
