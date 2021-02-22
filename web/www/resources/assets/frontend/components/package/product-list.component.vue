<template>
    <div class="list-area col-md-9 col-sm-8 col-xs-12" id="products">
        <ul>
            <li class="d-flex mb-4 all-food-list" v-for="(product, index) in getProducts">
                <div class="list-img">
                    <a class="" href="javascript:void(0)" data-toggle="modal" data-target="#details" @click.prevent="showDetails(product)">
                    <img :src="product.image || settings.logo" :alt="settings.name">
                    </a>
                </div>
                <div class="list-body ml-4 mr-2">
                    <a class="" href="javascript:void(0)" data-toggle="modal" data-target="#details" @click.prevent="showDetails(product)">
                        <h5>{{product.name}}</h5>
                        <ul class="list-body-mini-list">
                            <li v-if="product.unit"><a>Unit: {{product.unit.name}}</a></li>
                            <li><a>Vat: {{product.vat_percent}} %</a></li>
                        </ul>
                        <h6 class="text-danger" v-if="product.is_new == 1">New Food</h6>
                        <h6 class="text-danger" v-if="product.is_stock == 0">Stock Out</h6>
                        <p style="font-size: 14px;" class="text-muted mt-2">{{getDescription(product.description)}}</p>
                    </a>
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
                                <span> Add to Cart</span>
                            </loader-component>
                        </button>
                    </div>
                </div>
            </li>
        </ul>

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
        getDescription(text) {
            const words = _.words(text);
            return words.length > 20 ?
                words.splice(0, 20).join(' ')+' ...' : text;

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

</style>