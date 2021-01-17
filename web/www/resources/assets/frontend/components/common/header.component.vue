<template>
    <header>
        <div class="container">
            <div class="leftHeaderItem">
                <img :src="settings.logo" :alt="settings.name" />
            </div>

            <div class="temp-root">
                <h5 class="temp-text">
                    We are still working on our website.<br>
                    For place an order please<br>
                    Call: 01992641133
                </h5>

                <div class="pl-3">
                    <img :src="this.assetUrl('/logo/temp-img.jpg')" alt="Temp Image" />
                    <p class="temp-text-p">
                        <a href="https://www.just-eat.co.uk/" target="_blank" class="temp-text-a">
                            YOU CAN ALSO PLACE<br>
                            ORDER IN JUST EAT.
                        </a>
                    </p>
                </div>
            </div>

            <div class="d-flex rightHeaderItem">
                <div class="items mr-4 rightHeaderItem">
                    <div class="topMenu">
                        <ul>
                            <li><a :href="this.url('/contact')" class="text-capitalize">request call back</a></li>
                            <li><a :href="this.url('/signup')" class="text-capitalize">register</a></li>
                            <li><a :href="this.url('/login')" class="text-capitalize">login</a></li>
                        </ul>
                    </div>
                    <div class="mt-3 top-contact">
                        <div class="phone-num-bar">
                            <i class="fas fa-phone-alt icon"></i>
                            <div class="num">call: <span class="font-weight-bold">{{settings.phone_no}}</span></div>
                        </div>
                        <div class="cart-bar">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge badge-light">{{totalItems}}</span>
                            <div class="carts-section text-uppercase">
                                <span class="text-uppercase font-weight-bold">
                                    total items: <span class="text-danger font-weight-bold">{{totalItems}}</span>
                                    <span class="ml-2 mr-2"> | </span>
                                    total amount: <span class="text-danger font-weight-bold">${{totalSubTotal}}</span>
                                </span>

                            </div>
                        </div>
                        <div class="buisness-hour">
                            <i class="far fa-clock"></i>
                            <div class="time-table">
                                <a href="#time-table-bookmark" class="bookmark-text">
                                    <span class="text-uppercase font-weight-bold">
                                        opening time & delivery timeslot
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="qr-code">
                    <img class="img img-thumbnail img-qr-code img-fluid" :src="settings.qrcode" alt="QR-CODE">
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
            'customer'
        ]),
        ...mapGetters([
            'totalItems',
            'totalSubTotal'
        ])
    }
}
</script>

<style scoped>
.temp-notice > img{
    width: 80px;
    height: 65px;
}
.temp-text {
    color: white;
}
.temp-text-p{
    display: inline-block;
}
.temp-text-a{
    color: white;
}
.temp-text-a:hover{
    color: orange;
    text-decoration: none;
}

.temp-root{
    margin: auto;
    padding: 5px 15px 0px;
    text-align: center;
    display: inline-flex;
    position: absolute;
}

@media  screen and (max-width: 720px){
    .temp-root{
        position: unset;
        padding: 15px;
    }
}

</style>