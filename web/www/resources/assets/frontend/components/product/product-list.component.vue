<template>
    <div class="grid-area col-md-9 col-sm-8 col-xs-12" id="products">
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" v-for="(product, index) in getProducts">
                <div class="card h-100 food-order-card">
                    <img :src="product.image || settings.logo" class="card-img-top" :alt="product.name">
                    <div class="card-body grid-body">
                        <h5 class="card-title m-0">{{product.name}}</h5>
                        <ul class="list-body-mini-list">
                            <li v-if="product.unit"><a>Unit: {{product.unit.name}}</a></li>
                            <li><a>Vat: {{product.vat_percent}} %</a></li>
                        </ul>
                        <h6 class="text-danger" v-if="product.is_new == 1">New Food</h6>
                        <h6 class="text-danger" v-if="product.is_stock == 0">Stock Out</h6>
                        <hr>
                        <div class="d-grid grid-footer text-center">
                            <div class="discount-title">
                                <h5 class="text-danger" v-if="product.special_price">
                                    {{settings.currency_symbol}}{{product.special_price}} /
                                    <del>{{settings.currency_symbol}}{{product.regular_price}}</del>
                                </h5>
                                <h5 class="text-danger" v-else>
                                    {{settings.currency_symbol}}{{product.regular_price}}
                                </h5>
                            </div>
                            <div class="grid-footer-btn mt-2">
                                <button
                                    :disabled="loader[index] || product.is_stock == 0"
                                    @click="addToCart(index, product.id)"
                                    class="btn-grid-order text-capitalize">
                                    <loader-component :loader="loader[index]">
                                        <i class="fas fa-plus-circle"></i>
                                        &nbsp;<span>add cart</span>
                                    </loader-component>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        LoaderComponent
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
        const payload = {};
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