<template>
    <div class="list-area col-md-9 col-sm-8 col-xs-12" id="products">
        <ul>
            <li class="d-flex mb-4 all-food-list" v-for="(product, index) in getProducts">
                <div class="list-img">
                    <img :src="product.image || settings.logo" :alt="settings.name">
                </div>
                <div class="list-body ml-4 mr-2">
                    <h5>{{product.name}}</h5>
                    <ul class="list-body-mini-list">
                        <li v-if="product.unit"><a>Unit: {{product.unit.name}}</a></li>
                        <li><a>Vat: {{product.vat_percent}} %</a></li>
                    </ul>
                    <h6 class="text-danger" v-if="product.is_new == 1">New Food</h6>
                    <h6 class="text-danger" v-if="product.is_stock == 0">Stock Out</h6>
                    <p style="font-size: 14px;" class="text-muted mt-2">{{product.description}}</p>
                </div>
                <div class="list-footer">
                    <div class="discount-title">
                        <h5 class="text-danger" v-if="+product.special_price > 0">
                            {{settings.currency_symbol}}{{product.special_price}} /
                            <del>{{settings.currency_symbol}}{{product.regular_price}}</del>
                        </h5>
                        <h5 class="text-danger" v-else>
                            {{settings.currency_symbol}}{{product.regular_price}}
                        </h5>
                    </div>
                    <div class="list-footer-btn mt-4">
                        <button
                            :disabled="loader[index] || product.is_stock == 0"
                            @click="addToCart(index, product.id)"
                            class="btn-list-order">
                            <loader-component :loader="loader[index]">
                                <i class="fas fa-plus-circle"></i>
                                <span>Add Cart</span>
                            </loader-component>
                        </button>
                    </div>
                </div>
            </li>
        </ul>

        <product-pagination-component></product-pagination-component>
    </div>
</template>

<script>
import {mapGetters, mapState} from 'vuex';
import ProductPaginationComponent from './../common/product-pagination.component';
import LoaderComponent from './../common/loading.component';

export default {
    name: "product-list.component",
    components: {
        ProductPaginationComponent,
        LoaderComponent,
    },
    data() {
        return {
            loader: []
        }
    },
    computed: {
        ...mapState([
            'products',
            'settings'
        ]),
        ...mapGetters([
            'getProducts',
        ]),
    },
    created() {
        const url = new URL(window.location.href);
        const paths = url.pathname.split('/');
        const slug = paths.pop();
        const category_id = slug.split('-').pop();
        let ids = [];
        if (!isNaN(parseInt(category_id))) {
            ids.push(category_id);
        }
        const payload = {
            params: {
                sub_category_id: ids,
            }
        };
        this.$store.dispatch('getProducts', payload);
    },
    methods: {
        async addToCart(index, product_id) {
            if (product_id) {
                this.loader[index] = true;
                const payload = {
                    product_id
                }
                await this.$store.dispatch('addItemToCart', payload);
                this.loader[index] = false;
            }
        }
    }
}
</script>

<style scoped>

</style>