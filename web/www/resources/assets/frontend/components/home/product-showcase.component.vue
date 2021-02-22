<template>
    <section id="orderFoods" class="container mt-5">
        <div class="text-center mb-4 d-block">
            <h1 class="text-shadow section-title">Our Food Styles</h1>
            <div class="underline mt-2 title-underline"></div>
        </div>
        <div class="row mt-5 top-sales-food">
            <div class="col-md-4 mb-5" v-for="(product, index) in getProducts">
                <div class="card special-food-card" style="width: 20rem;">
                    <a class="" href="javascript:void(0)" data-toggle="modal" data-target="#details" @click.prevent="showDetails(product)">
                        <img :src="product.image ? product.image : settings.logo" class="card-img-top cart-img food-style-cart" :alt="settings.name">
                    </a>
                    <div class="card-body">
                        <a class="" href="javascript:void(0)" data-toggle="modal" data-target="#details" @click.prevent="showDetails(product)">
                            <h5 class="card-title text-uppercase font-weight-bold">{{product.name}}</h5>
                            <p class="text-danger mb-2 font-weight-bold">
                                <span v-if="product.special_price > 0">
                                {{settings.currency_symbol}}{{product.special_price}} /
                                <del>{{settings.currency_symbol}}{{product.regular_price}}</del>
                                </span>
                                <span v-else>
                                    {{settings.currency_symbol}}{{product.regular_price}}
                                </span>
                            </p>
                            <p class="text-muted mb-2 description">
                                {{getDescription(product.description)}}
                            </p>
                        </a>
                        <button
                            :disabled="loader[index]"
                            @click="addToCart(index, product.id)"
                            class="btn btn-custom">
                                <loader-component :loader="loader[index]">
                                    <i class="fas fa-plus-circle"></i>
                                    <span class="text-capitalize"> add to cart</span>
                                </loader-component>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
            <a :href="this.url('/food-orders')">See more foods...</a>
        </div>
    </section>

    <modal-component v-if="modal.id === 'details'">
        <product-details-component :details="details"></product-details-component>
    </modal-component>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
import LoaderComponent from './../common/loading.component';
import ModalComponent from './../common/modal.component';
import ProductDetailsComponent from './../common/product-details.component';

export default {
    name: "product-showcase.component",
    components: {
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
            'getProducts'
        ]),
    },
    created() {
        const payload = {
            params: {
                limit: 12,
                is_active: 1,
                is_stock: 1,
            },
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