<template>
    <div class="grid-area col-md-9 col-sm-8 col-xs-12" id="products">
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" v-for="(product, index) in getProducts">
                <div class="card h-100 food-order-card">
                    <img :src="product.image || this.assetUrl('/logo/logo.png')" class="card-img-top" alt="...">
                    <div class="card-body grid-body">
                        <h5 class="card-title">{{product.name}}</h5>
                        <ul class="list-body-mini-list">
                            <li v-if="product.unit"><a>Unit: {{product.unit.name}}</a></li>
                            <li><a>Vat: {{product.vat_percent}} %</a></li>
                        </ul>
                        <hr>
                        <div class="d-grid grid-footer text-center">
                            <div class="discount-title">
                                <h5 class="text-danger" v-if="product.special_price"> {{product.special_price}} / <del>{{product.regular_price}}</del></h5>
                                <h5 class="text-danger" v-else>{{product.regular_price}}</h5>
                            </div>
                            <div class="grid-footer-btn mt-2">
                                <button class="btn-grid-order text-capitalize">
                                    <i class="fas fa-plus-circle"></i>
                                    &nbsp;
                                    <span>add cart</span>
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

export default {
    name: "product-list.component",
    components: {
        ProductPaginationComponent,
    },
    computed: {
        ...mapState([
            'products',
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
    }
}
</script>

<style scoped>

</style>