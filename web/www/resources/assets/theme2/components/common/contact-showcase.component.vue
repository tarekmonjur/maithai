<template>
    <section class="jumbotron contact-jumbo mb-4">
        <div class="container">
            <!-- 1st Row -->
            <div class="row">
                <div class="col-md-12 text-center mb-5 d-block">
                    <h2 class="text-capitalize contact-us-title section-title">contact us</h2>
                    <p class="text-capitalize">for any queries or concerns</p>
                    <div class="underline mt-3 m-auto" style="border-bottom: 4px solid tomato; width: 5rem; padding-top: 15px;"></div>
                </div>
            </div>
            <!-- 2nd Row -->
            <div class="row text-center">
                <div class="col-md-4 d-block contact-col">
                    <div class="rounded-contact-icon m-auto">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h6 class="font-weight-bold">Address</h6>
                    <p class="text-muted" v-html="settings.address"></p>
                </div>
                <div class="col-md-4 d-block contact-col">
                    <div class="rounded-contact-icon m-auto">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h6 class="font-weight-bold">Phone Number</h6>
                    <p class="text-muted">{{settings.phone ? settings.phone : settings.mobile}}</p>
                </div>
                <div class="col-md-4 d-block contact-col">
                    <div class="rounded-contact-icon m-auto">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h6 class="font-weight-bold">Email</h6>
                    <p class="text-muted">{{settings.email}}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "contact-showcase.component",
    computed: {
        ...mapState([
            'settings',
        ]),
    }
}
</script>

<style scoped>

</style>