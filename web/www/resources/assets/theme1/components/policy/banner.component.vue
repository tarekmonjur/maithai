<template>
    <section id="policy-cover">
        <div class="jumbotron">
            <div class="policy-text-section">
                <div class="policy-cover text-light text-capitalize text-center">
                    <h1 class="display-3">terms<br>policy</h1>
                    <p>{{settings.name}} is a Restaurant.</p>
                    <p>Ordering Food & Delivery from restaurants of choice.</p>
                    <p>Table booking & Restaurants.</p>
                    <p>Deals & Discounts</p>
                    <p>Party Halls online booking</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "banner.component",
    computed: {
        ...mapState(['settings'])
    },
}
</script>

<style scoped>

</style>