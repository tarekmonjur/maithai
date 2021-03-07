<template>
    <div class="grid-area col-md-9 col-sm-8 col-xs-12" id="products">
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4 text-center" v-for="(product, index) in getProducts">
                <div class="card h-100 food-order-card">
                    <a class="" href="javascript:void(0)" data-toggle="modal" data-target="#details" @click.prevent="showDetails(product)">
                    <img :src="product.image || settings.logo" class="card-img-top" :alt="product.name">
                    </a>
                    <div class="card-body grid-body">
                        <a class="" href="javascript:void(0)" data-toggle="modal" data-target="#details" @click.prevent="showDetails(product)">
                            <h5 class="card-title m-0">{{product.name}}</h5>
                            <ul class="list-body-mini-list">
                                <li v-if="product.unit"><a>Unit: {{product.unit.name}}</a></li>
                                <li><a>Vat: {{product.vat_percent}} %</a></li>
                            </ul>
                            <h6 class="text-danger" v-if="product.is_new == 1">New Food</h6>
                            <h6 class="text-danger" v-if="product.is_stock == 0">Stock Out</h6>
                            <div class="discount-title">
                                <h5 class="text-danger" v-if="+product.special_price > 0">
                                    {{settings.currency_symbol}}{{product.special_price}} /
                                    <del>{{settings.currency_symbol}}{{product.regular_price}}</del>
                                </h5>
                                <h5 class="text-danger" v-else>
                                    {{settings.currency_symbol}}{{product.regular_price}}
                                </h5>
                            </div>
                            <hr v-if="product.description">
                            <p class="text-muted mb-2 description">
                                {{getDescription(product.description)}}
                            </p>
                        </a>
                        <div class="d-grid grid-footer text-center">
                            <div class="grid-footer-btn mt-2">
                                <button
                                    :disabled="loader[index] || product.is_stock == 0"
                                    @click="addToCart(index, product.id)"
                                    class="btn-grid-order text-capitalize">
                                    <loader-component :loader="loader[index]">
                                        <i class="fas fa-plus-circle"></i>
                                        &nbsp;<span>add to cart</span>
                                    </loader-component>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr style="height: 1px">
                </div>
            </div>
        </div>

        <product-pagination-component></product-pagination-component>
    </div>

    <modal-component v-if="modal.id === 'details'">
        <product-details-component :details="details"></product-details-component>
    </modal-component>
</template>

<script>
import {mapGetters, mapState} from 'vuex';
import ProductPaginationComponent from './../common/product-pagination.component';
import LoaderComponent from './../common/loading.component';
import ModalComponent from './../common/modal.component';
import ProductDetailsComponent from './../common/product-details.component';

export default {
    name: "product-list.component",
    components: {
        ProductPaginationComponent,
        LoaderComponent,
        ModalComponent,
        ProductDetailsComponent
    },
    data() {
        return {
            loader: [],
            details: {},
        }
    },
    computed: {
        ...mapState([
            'products',
            'settings',
            'modal'
        ]),
        ...mapGetters([
            'getProducts',
        ]),
    },
    created() {
        const url = new URL(window.location.href);
        const paths = url.pathname.split('/');
        const slug = paths.pop();
        const category_id = url.searchParams.get('cat');
        const sub_category_id = url.searchParams.get('subcat');
        let cat_ids = [];
        let sub_ids = [];
        if (!isNaN(parseInt(category_id))) {
            cat_ids.push(category_id);
        }
        if (!isNaN(parseInt(sub_category_id))) {
            sub_ids.push(sub_category_id);
        }
        const payload = {
            params: {
                category_id: cat_ids,
                sub_category_id: sub_ids,
            }
        };
        this.$store.dispatch('getProducts', payload);
    },
    methods: {
        getDescription(text) {
            const words = _.words(text);
            return words.length > 15 ?
                words.splice(0, 15).join(' ')+' ...' : text;

        },
        async addToCart(index, product_id) {
            if (product_id) {
                this.loader[index] = true;
                const payload = {
                    product_id
                }
                await this.$store.dispatch('addItemToCart', payload);
                this.loader[index] = false;
            }
        },
        showDetails(product) {
            this.$store.commit('setModal', {
                id: 'details',
                title: this.trans('product_details'),
                button: false,
            });
            this.details = product;
        }
    }
}
</script>

<style scoped>
.description{
    font-size: 14px;
}
.card-body a {
    text-decoration: none;
}
</style>