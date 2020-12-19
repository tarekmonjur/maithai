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
            <td>{{lang(`code`)}}</td>
            <td>{{showData.code}}</td>
        </tr>
        <tr>
            <td>{{lang(`barcode`)}}</td>
            <td>{{showData.barcode}}</td>
        </tr>
        <tr>
            <td>{{lang(`sorting`)}}</td>
            <td>{{showData.sorting}}</td>
        </tr>
        <tr>
            <td>{{lang(`regular_price`)}}</td>
            <td>{{showData.regular_price}}</td>
        </tr>
        <tr>
            <td>{{lang(`special_price`)}}</td>
            <td>{{showData.special_price}}</td>
        </tr>
        <tr>
            <td>{{lang(`vat_percent`)}}</td>
            <td>{{showData.vat_percent}}</td>
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
            <td>{{lang(`unit`)}}</td>
            <td>{{showData.unit && showData.unit.name}}</td>
        </tr>
        <tr>
            <td>{{lang(`category`)}}</td>
            <td>{{showData.category && showData.category.name}}</td>
        </tr>
        <tr>
            <td>{{lang(`sub_category`)}}</td>
            <td>{{showData.sub_category && showData.sub_category.name}}</td>
        </tr>
        <tr>
            <td>{{lang(`is_active`)}}</td>
            <td>{{this.isActive(showData.is_active)}}</td>
        </tr>
        <tr>
            <td>{{lang(`is_package`)}}</td>
            <td>{{this.isPackage(showData.is_package)}}</td>
        </tr>
        <tr>
            <td>{{lang(`is_new`)}}</td>
            <td>{{this.isNew(showData.is_new)}}</td>
        </tr>
        <tr>
            <td>{{lang(`is_stock`)}}</td>
            <td>{{this.isStock(showData.is_stock)}} ({{showData.stock}})</td>
        </tr>
        <tr>
            <td>{{lang(`stocks`)}}</td>
            <td>
                <table class="table table-broder">
                    <thead class="bg-gray">
                    <tr>
                        <td>{{lang('sku_name')}}</td>
                        <td>{{lang('sku_code')}}</td>
                        <td>{{lang('stock')}}</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="stock in showData.stocks">
                        <td>{{stock.sku && stock.sku.name}}</td>
                        <td>{{stock.sku && stock.sku.code}}</td>
                        <td>{{stock.stock}}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>{{lang(`variants`)}}</td>
            <td>
                <table class="table table-border">
                    <thead class="bg-gray">
                    <tr>
                        <td>{{lang('variant')}}</td>
                        <td>{{lang('sub_variant')}}</td>
                        <td>{{lang('additional_price')}}</td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="variant in showData.variants">
                            <td>{{variant.variant.name || ''}}</td>
                            <td>{{variant.sub_variant.name || ''}}</td>
                            <td>{{variant.additional_price}}</td>
                        </tr>
                    </tbody>
                </table>
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
