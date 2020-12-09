<template>
    <table-view-component>
        <tr>
            <td>{{lang(`id`)}}</td>
            <td>{{showData.id}}</td>
        </tr>
        <tr>
            <td>{{lang(`category`)}}</td>
            <td>{{showData.category.name}}</td>
        </tr>
        <tr>
            <td>{{lang(`name`)}}</td>
            <td>{{showData.name}}</td>
        </tr>
        <tr>
            <td>{{lang(`image`)}}</td>
            <td><img :src="showData.image" alt="" width="60"></td>
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
            <td>{{lang(`products`)}} ({{showData.products_count}})</td>
            <td>
                <span v-for="product in showData.products">{{product.name}},&nbsp;</span>
            </td>
        </tr>
        <tr>
            <td>{{lang(`description`)}}</td>
            <td>{{showData.description}}</td>
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
