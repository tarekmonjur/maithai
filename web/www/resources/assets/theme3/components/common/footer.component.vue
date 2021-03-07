<template>
    <footer class="footer text-light">
        <div id="upper-footer" class="p-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <ul class="footer-top-menu">
                            <li>
                                <a :href="this.url('/about')">About</a>
                                <span class="ml-2 mr-2 line"> - </span>
                            </li>
                            <li>
                                <a :href="this.url('terms-policy')">Refund Policy</a>
                                <span class="ml-2 mr-2 line"> - </span>
                            </li>
                            <li>
                                <a :href="this.url('contact')">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div style="border-bottom: 1px dotted white;"></div>

                <div class="row mb-2 footer-list-1st-heading mt-5">
                    <div class="col-md-12">
                        <h5 class="text-light text-capitalize">address :</h5>
                    </div>
                </div>
                <div class="row mb-4 footer-list-1st-row">
                    <div class="col-md-4">
                        <div v-html="settings.address"></div>
                        <div class="mt-3">
                            <ul>
                                <li v-if="settings.phone">Phone: {{settings.phone}}</li>
                                <li v-if="settings.mobile">Mobile: {{settings.mobile}}</li>
                                <li v-if="settings.email">E-mail: {{settings.email}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li v-if="settings.registration_number">Company Registration Number: {{settings.registration_number}}</li>
                            <li v-if="settings.vat_number">VAT: {{settings.vat_number}}</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <img :src="settings.rating_image" alt="ratting" class="img img-fluid">
                    </div>
                </div>
                <br>
                <div style="border-bottom: 1px dotted white;"></div>

                <div class="row mt-5 footer-list-2nd-row mb-5">
                    <div class="col-md-4 business-hour" id="time-table-bookmark">
                        <h5 class="text-capitalize mb-3">opening time:</h5>
                        <div v-html="settings.opening_time"></div>
                    </div>

                    <div class="col-md-4 business-hour" id="time-table-bookmark">
                        <h5 class="text-capitalize mb-3">delivery time:</h5>
                        <div v-html="settings.delivery_time"></div>
                    </div>

                    <div class="col-md-4">
                        <h5 class="text-capitalize mb-3">Payment Methods:</h5>
                        <img :src="settings.payment_image" alt="ratting" class="img img-fluid">
                    </div>
                </div>

                <div style="border-bottom: 1px dotted white;"></div>

                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <small>&copy; Copyright 2020, {{settings.name}}. All Rights Reserved</small>
                    </div>
                </div>
            </div>
        </div>

        <!------- BOTTOM tomato FOOTER -------->
        <div id="bottom-footer" class="p-2">
            <div class="container">
                <div class="row">
                    <!-- Footer App Logo -->
                    <div class="col-md-4">
                        <div class="logo">
                            <img :src="settings.logo" alt="">
                        </div>
                    </div>

                    <div class="col-md-4 footer-social-icons" style="display: inline-flex; justify-content: center;">
                        <div class="d-flex mt-4">
                            <a href="https://www.facebook.com/mai1thaikitchen" class="ml-4">
                                <i class="fab fa-facebook-f"></i>
                            </a>

                            <a href="https://www.instagram.com/maithai_kitchen/?igshid=6evz8zz35st5" target="blank" class="ml-4">
                                <i class="fab fa-instagram"></i>
                            </a>

                            <a href="https://youtube.com/channel/UCDHzPwaAsL3CORkpLSf-JEQ" class="ml-4">
                                <i class="fab fa-youtube"></i>
                            </a>

                            <a href="" class="ml-4">
                                <i class="fab fa-twitter"></i>
                            </a>

                            <a href="https://www.tripadvisor.co.uk/Profile/Maithaikitchen" class="ml-4" target="blank">
                                <i class="fab fa-tripadvisor"></i>
                            </a>
                        </div>
                    </div>

                    <!-- <div class="col-md-4 footer-qr-code" style="display: inline-flex; justify-content: flex-end;">
                        <img class="img img-fluid img-qr-code img-thumbnail" :src="settings.qrcode"
                             alt="QR-CODE">
                    </div> -->
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name: "footer.component",
    computed: {
        ...mapState(['settings'])
    },
}
</script>

<style scoped>

</style>