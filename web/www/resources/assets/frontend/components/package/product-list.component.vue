<template>
    <div class="list-area col-md-9 col-sm-8 col-xs-12" id="products">
        <ul>
            <li class="d-flex mb-4 all-food-list" v-for="(product, index) in getProducts">
                <div class="list-img">
                    <img :src="product.image || this.assetUrl('/logo/logo.png')" alt="...">
                </div>
                <div class="list-body ml-4 mr-2">
                    <h5>{{product.name}}</h5>
                    <ul class="list-body-mini-list">
                        <li v-if="product.unit"><a>Unit: {{product.unit.name}}</a></li>
                        <li><a>Vat: {{product.vat_percent}} %</a></li>
                    </ul>
                    <p style="font-size: 14px;" class="text-muted mt-2">{{product.description}}</p>
                </div>
                <div class="list-footer">
                    <div class="discount-title">
                        <h5 class="text-danger" v-if="product.special_price"> {{product.special_price}} / <del>{{product.regular_price}}</del></h5>
                        <h5 class="text-danger" v-else>{{product.regular_price}}</h5>
                    </div>
                    <div class="list-footer-btn mt-4">
                        <button class="btn-list-order">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add Cart</span>
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