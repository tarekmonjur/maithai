<template>
    <section class="jumbotron jumbo-one mt-0 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-jumbo-one">
                    <div class="rounded-icon"><i class="fas fa-bolt"></i></div>
                    <p>Fast Delivery</p>
                </div>
                <div class="col-md-3 col-jumbo-one">
                    <div class="rounded-icon"><i class="fas fa-weight"></i></div>
                    <p>Minimum order {{settings.currency_symbol}}{{settings.minimum_order}}</p>
                </div>
                <div class="col-md-3 col-jumbo-one">
                    <div class="rounded-icon"><i class="far fa-credit-card"></i></div>
                    <p>Pay via Card/Cash</p>
                </div>
                <div class="col-md-3 col-jumbo-one">
                    <div class="rounded-icon">{{settings.currency_symbol}}</div>
                    <p>Deals Discounts</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name: "delivery-showcase.component",
    computed: {
        ...mapState([
            'settings'
        ])
    }
}
</script>

<style scoped>

</style>