<template>
    <section class="container mt-5">
        <div class="text-center mb-4 d-block">
            <h1 class="text-shadow section-title">Our Food Styles</h1>
            <div class="underline mt-2 title-underline"></div>
        </div>
        <div class="row mt-5 top-sales-food">
            <div class="col-md-4 mb-5" v-for="(product, index) in getProducts">
                <div class="card special-food-card" style="width: 20rem;">
<!--                     <div class="cart-top-banner"></div>-->
                    <img :src="product.image ? product.image : this.assetUrl('/logo/logo.png')" class="card-img-top cart-img food-style-cart" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase font-weight-bold">{{product.name}}</h5>
                        <!-- <p class="text-danger mb-2 font-weight-bold">$800.00</p>
                        <p class="text-muted mb-2">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos fugit blanditiis libero
                            debitis!
                        </p> -->
                        <a href="#" class="btn btn-custom">
                            <i class="fas fa-plus-circle"></i>
                            <span class="text-capitalize">add cart</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapState, mapGetters} from 'vuex';

export default {
    name: "product-showcase.component",
    computed: {
        ...mapState([
            'products'
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
            },
        };
        this.$store.dispatch('getProducts', payload);
    },
    // updated() {
    //     console.log(this.getProducts);
    // }
}
</script>

<style scoped>

</style>