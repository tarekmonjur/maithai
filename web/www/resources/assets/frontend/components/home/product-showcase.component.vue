<template>
    <section id="orderFoods" class="container mt-5">
        <div class="text-center mb-4 d-block">
            <h1 class="text-shadow section-title">Our Food Styles</h1>
            <div class="underline mt-2 title-underline"></div>
        </div>
        <div class="row mt-5 top-sales-food">
            <div class="col-md-4 mb-5" v-for="(product, index) in getProducts">
                <div class="card special-food-card" style="width: 20rem;">
                    <img :src="product.image ? product.image : settings.logo" class="card-img-top cart-img food-style-cart" :alt="settings.name">
                    <div class="card-body">
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
                        <button
                            :disabled="loader[index]"
                            @click="addToCart(index, product.id)"
                            class="btn btn-custom">
                                <loader-component :loader="loader[index]">
                                    <i class="fas fa-plus-circle"></i>
                                    <span class="text-capitalize">add cart</span>
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
</template>

<script>
import {mapState, mapGetters} from 'vuex';
import LoaderComponent from './../common/loading.component';

export default {
    name: "product-showcase.component",
    components: {
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