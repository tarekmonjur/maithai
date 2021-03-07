<template>
    <header>
        <div class="container">
            <div class="leftHeaderItem">
                <img :src="settings.logo" :alt="settings.name" />
            </div>
            <div class="d-flex rightHeaderItem">
                <div class="items mr-4 rightHeaderItem">
                    <div class="topMenu">
                        <ul>
                            <li><a :href="this.url('/contact')" class="text-capitalize">request call back</a></li>
                            <li>
                                <a v-if="!isAuthenticated" :href="this.url('/signup')" class="text-capitalize">Register</a>
                                <a v-else :href="this.url('/my-orders')" class="text-capitalize">My Orders</a>
                            </li>
                            <li>
                                <a v-if="!isAuthenticated" :href="this.url('/login')" class="text-capitalize">Login</a>
                                <a v-else :href="this.url('/logout')" class="text-capitalize">Logout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-3 top-contact">
                        <div class="phone-num-bar">
                            <i class="fas fa-phone-alt icon"></i>
                            <div class="num">call: <a :href="phoneNumber" class="font-weight-bold">{{settings.phone ? settings.phone : settings.mobile}}</a></div>
                        </div>
                        <div class="cart-bar">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge badge-light">{{totalItems}}</span>
                            <div class="carts-section text-uppercase">
                                <span class="text-uppercase font-weight-bold">
                                    total items: <span class="text-danger font-weight-bold">{{totalItems}}</span>
                                    <span class="ml-2 mr-2"> | </span>
                                    total amount: <span class="text-danger font-weight-bold">{{settings.currency_symbol}}{{totalSubTotal}}</span>
                                </span>

                            </div>
                        </div>
                        <div class="buisness-hour">
                            <i class="far fa-clock"></i>
                            <div class="time-table">
                                <a href="#time-table-bookmark" class="bookmark-text">
                                    <span class="text-uppercase font-weight-bold">
                                        opening & delivery timeslot
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <header class="order-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-2 mb-2">
                    <h4 class="temp-text">
                        <a :href="phoneNumber" class="temp-text-a">
                        Call Now to Book a Table or to Place an Order <br>
                        <i class="fas fa-phone-alt icon"></i>&nbsp;{{settings.phone ? settings.phone : settings.mobile}}
                        </a>
                    </h4>
                </div>

                <!-- <div class="col-md-6 mt-2 mb-2">
                    <div class="pl-3">
                        <img class="mr-2" :src="this.assetUrl('/logo/temp-img.jpg')" :alt="settings.name" />
                        <h5 class="temp-text">
                            <a href="https://www.just-eat.co.uk/" target="_blank" class="temp-text-a">
                                YOU CAN ALSO PLACE<br>
                                ORDER IN JUST EAT.
                            </a>
                        </h5>
                    </div>
                </div> -->
            </div>
        </div>
    </header>

    <header class="time-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="p-3 mb-2 time-border">Opening Time</h4>
                    <div v-html="settings.opening_time"></div>
                </div>
                <div class="col-md-4 mb-4">
                    <h4 class="p-3 mb-2 time-border">Delivery Time</h4>
                    <div v-html="settings.delivery_time"></div>
                </div>
                <div class="col-md-4 mb-4">
                    <img :src="settings.rating_image" alt="ratting" style="width: 230px; height: 150px">
                </div>
            </div>
        </div>
    </header>

</template>

<script>
import {mapState, mapGetters} from 'vuex';

export default {
    name: "header.component",
    computed: {
        ...mapState([
            'settings',
            'customer',
        ]),
        ...mapGetters([
            'isAuthenticated',
            'totalItems',
            'totalSubTotal'
        ]),
        phoneNumber() {
            return 'tel:'+(this.settings.phone ? this.settings.phone : this.settings.mobile).trim();
        }
    },
}
</script>

<style scoped>

.time-header {
    text-align: center;
    font-weight: bold;
    color: white;
}
.time-border {
    border-bottom: 2px solid #c99a5a;
    text-shadow: 2px 2px 2px black
}
.order-header {
    text-align: center;
    font-weight: bold;
    color: white;
    background-color: #c99a5a;
}
.temp-text {
    color: white;
    display: inline-block;
    vertical-align: middle;
    text-shadow: 2px 2px 2px black
}
.temp-text-a{
    color: white;
    text-shadow: 2px 2px 2px black
}
.temp-text-a:hover{
    color: #d2232b;
    text-decoration: none;
    text-shadow: 2px 2px 2px black
}

</style>