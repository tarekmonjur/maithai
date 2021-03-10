<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card special-food-card" style="min-height: auto">
                <img v-if="details.image" :src="details.image" class="card-img-top cart-img food-style-cart" :alt="settings.name">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">{{details.name}}</h5>
                    <p class="text-danger mb-2 font-weight-bold">
                                <span v-if="details.special_price > 0">
                                {{settings.currency_symbol}}{{details.special_price}} /
                                <del>{{settings.currency_symbol}}{{details.regular_price}}</del>
                                </span>
                        <span v-else>
                                    {{settings.currency_symbol}}{{details.regular_price}}
                                </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h6 v-if="details.unit">Unit: {{details.unit.name}}</h6>
            <h6>Vat: {{details.vat_percent}} %</h6>
            <hr>
            <div v-if="details.description">
                <h5 class="card-title text-uppercase font-weight-bold mb-1">Description :</h5>
                <p class="text-muted mb-2">
                    {{details.description}}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';
export default {
    name: "product-details.component",
    props: ['details'],
    computed: {
        ...mapState([
            'settings',
        ]),
    }
}
</script>

<style scoped>

</style>