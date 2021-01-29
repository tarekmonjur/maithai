<template>
    <div class="shopping-cart sticky">
        <!-- Close Icons Button -->
        <div class="shoppingCartButton"></div>
        <!-- Drawer Opening Button When Drawer will close this will appear -->
        <!-- Showing Icon and Drawer opening Bar(When Drawer is Close) -->
        <section class="stickyHeader sticky-open-btn">
            <div class="shopping-badget-items-counter">
                <!-- The Shopping Bag Icon -->
                <svg version="1.1" id="Calque_1" x="0px" y="0px" style="fill:#FDD670; stroke:#FDD670;" width="16px"
                     height="24px" viewBox="0 0 100 160.13">
                    <polygon points="11.052,154.666 21.987,143.115 35.409,154.666"></polygon>
                    <path
                        d="M83.055,36.599c-0.323-7.997-1.229-15.362-2.72-19.555c-2.273-6.396-5.49-7.737-7.789-7.737   c-6.796,0-13.674,11.599-16.489,25.689l-3.371-0.2l-0.19-0.012l-5.509,1.333c-0.058-9.911-1.01-17.577-2.849-22.747   c-2.273-6.394-5.49-7.737-7.788-7.737c-8.618,0-17.367,18.625-17.788,37.361l-13.79,3.336l0.18,1.731h-0.18v106.605l17.466-17.762   l18.592,17.762V48.06H9.886l42.845-10.764l2.862,0.171c-0.47,2.892-0.74,5.865-0.822,8.843l-8.954,1.75v106.605l48.777-10.655   V38.532l0.073-1.244L83.055,36.599z M36.35,8.124c2.709,0,4.453,3.307,5.441,6.081c1.779,5.01,2.69,12.589,2.711,22.513   l-23.429,5.667C21.663,23.304,30.499,8.124,36.35,8.124z M72.546,11.798c2.709,0,4.454,3.308,5.44,6.081   c1.396,3.926,2.252,10.927,2.571,18.572l-22.035-1.308C61.289,21.508,67.87,11.798,72.546,11.798z M58.062,37.612l22.581,1.34   c0.019,0.762,0.028,1.528,0.039,2.297l-23.404,4.571C57.375,42.986,57.637,40.234,58.062,37.612z M83.165,40.766   c-0.007-0.557-0.01-1.112-0.021-1.665l6.549,0.39L83.165,40.766z">
                    </path>
                </svg>
                <p class="shopping-cart-items">
                    <span class="mr-1">{{totalItems}}</span>
                    <span>ITEMS</span>
                </p>
            </div>
            <div class="total shopping-badget-total">
                <span class="dollar">{{settings.currency_symbol}}</span>
                <span class="price">{{totalSubTotal}}</span>
            </div>
        </section>
        <!--END of The Drawer Opening Button-->

        <!-- Shopping Cart Header -->
        <div class="cart-header d-flex">
            <div class="left-header-item">
                <svg class="mr-1" version="1.1" id="Calque_1" x="0px" y="0px"
                     style="fill:#fff; stroke:#fff; margin-top: -1px;" width="20px" height="30px"
                     viewBox="0 0 100 160.13">
                    <polygon points="11.052,154.666 21.987,143.115 35.409,154.666"></polygon>
                    <path
                        d="M83.055,36.599c-0.323-7.997-1.229-15.362-2.72-19.555c-2.273-6.396-5.49-7.737-7.789-7.737   c-6.796,0-13.674,11.599-16.489,25.689l-3.371-0.2l-0.19-0.012l-5.509,1.333c-0.058-9.911-1.01-17.577-2.849-22.747   c-2.273-6.394-5.49-7.737-7.788-7.737c-8.618,0-17.367,18.625-17.788,37.361l-13.79,3.336l0.18,1.731h-0.18v106.605l17.466-17.762   l18.592,17.762V48.06H9.886l42.845-10.764l2.862,0.171c-0.47,2.892-0.74,5.865-0.822,8.843l-8.954,1.75v106.605l48.777-10.655   V38.532l0.073-1.244L83.055,36.599z M36.35,8.124c2.709,0,4.453,3.307,5.441,6.081c1.779,5.01,2.69,12.589,2.711,22.513   l-23.429,5.667C21.663,23.304,30.499,8.124,36.35,8.124z M72.546,11.798c2.709,0,4.454,3.308,5.44,6.081   c1.396,3.926,2.252,10.927,2.571,18.572l-22.035-1.308C61.289,21.508,67.87,11.798,72.546,11.798z M58.062,37.612l22.581,1.34   c0.019,0.762,0.028,1.528,0.039,2.297l-23.404,4.571C57.375,42.986,57.637,40.234,58.062,37.612z M83.165,40.766   c-0.007-0.557-0.01-1.112-0.021-1.665l6.549,0.39L83.165,40.766z">
                    </path>
                </svg>
                <span class="mr-1 mt-2"></span>
                <span class="text-uppercase mt-2">items</span>
            </div>

            <div class="right-header-item">
                <button class="shopping-car-close-btn">
                    close
                </button>
                &nbsp;
                <button class="shopping-car-close-btn bg-danger border-danger"
                        v-if="totalItems"
                        @click.prevent="clearCart()">
                    clear
                </button>
            </div>
        </div>
        <!--END of Shopping-Cart Header-->

        <div class="cart-content-empty" v-if="!totalItems">
            <div class="content-item-empty">
                <img :src="this.assetUrl('/logo/shopping-beg-1.png')" alt="No Items!!!">
                <div class="shopping-title-empty text-capitalize">
                    <p class="text-muted">Your cart is empty!</p>
                </div>
            </div>
        </div>
        <div v-if="totalItems" class="cart-content">
            <div class="row content-title">
                <div class="col-md-12 body-heading-title">
                    <p>Your delivery items</p>
                </div>
            </div>

            <div class="row content-title items-nav sticky-top">
                <div class="col-3">Name</div>
                <div class="col-1">Unit</div>
                <div class="col-2">Price</div>
                <div class="col-2">QTY</div>
                <div class="col-1">Discount</div>
                <div class="col-1">Vat</div>
                <div class="col-2">SubTotal</div>
            </div>
            <div class="row content-items-list" v-for="(item, index) in shoppingCart.items">
                <div class="col-3 single-item">
                    <a href="javascript:void(0)"
                       @click.prevent="deleteToCart(index)"
                       class="float-left text-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    <span>{{item.product_name}}</span>
                </div>
                <div class="col-1 single-item">
                    <span>{{item.product_unit}}</span>
                </div>
                <div class="col-2 single-item">
                    <span class="text-danger">{{settings.currency_symbol}}{{item.product_price}}</span>
                    <span class="text-muted" v-if="item.discount_amount > 0">
                        <del>{{settings.currency_symbol}}{{item.product_price+item.discount_amount}}</del>
                    </span>
                </div>
                <div class="col-2 single-item">
                    <input class="form-control form-control-sm"
                           type="number"
                           @keyup="updateToCart($event, index)"
                           @change.lazy="updateToCart($event, index)"
                           :value="item.product_qty">
                </div>
                <div class="col-1 single-item">
                    <span class="text-danger">{{settings.currency_symbol}}{{item.discount_amount}}</span>
                </div>
                <div class="col-1 single-item">
                    <span class="text-danger">{{settings.currency_symbol}}{{item.vat_amount}}</span>
                </div>
                <div class="col-2 single-item">
                    <span class="text-danger">{{settings.currency_symbol}}{{item.sub_total}}</span>
                </div>
            </div>
            <div class="row content-items-list border-top">
                <div class="col-4 single-item"><strong>Total</strong></div>
                <div class="col-2 single-item"><strong>{{settings.currency_symbol}}{{totalPrice}}</strong></div>
                <div class="col-2 single-item"><strong>{{totalQty}}</strong></div>
                <div class="col-1 single-item"><strong>{{settings.currency_symbol}}{{totalDiscount}}</strong></div>
                <div class="col-1 single-item"><strong>{{settings.currency_symbol}}{{totalVat}}</strong></div>
                <div class="col-2 single-item"><strong>{{settings.currency_symbol}}{{totalSubTotal}}</strong></div>
            </div>
            <div class="row">
                <div class="col p-1 pt-2">
                    <h6 class="border-bottom pb-1">Delivery Address:</h6>
                    <address>
                        {{shippingDetails.full_name}} <br>
                        {{shippingDetails.email}} <br>
                        {{shippingDetails.mobile_no}} <br>
                        {{shippingDetails.city ? shippingDetails.city+',' : ''}}
                        {{shippingDetails.state ? shippingDetails.state+',' : ''}}
                        {{shippingDetails.zip_code}} <br>
                        {{shippingDetails.address}}
                    </address>
                </div>
                <div class="col p-1 pt-2">
                    <div class="row content-items-list border-0 pt-0">
                        <div class="col-8 single-item border-bottom"><strong>Sub Total Amount</strong></div>
                        <div class="col-4 single-item border-bottom">{{settings.currency_symbol}}{{totalSubTotal}}</div>
                    </div>
                    <div class="row content-items-list border-0 pt-0">
                        <div class="col-8 single-item border-bottom"><strong>Processing Fee</strong></div>
                        <div class="col-4 single-item border-bottom">{{settings.currency_symbol}}{{settings['processing_fee']}}</div>
                    </div>
                    <div class="row content-items-list border-0 pt-0">
                        <div class="col-8 single-item border-bottom"><strong>Delivery Fee</strong></div>
                        <div class="col-4 single-item border-bottom">{{settings.currency_symbol}}{{settings['delivery_fee']}}</div>
                    </div>
                    <div class="row content-items-list border-0 pt-0">
                        <div class="col-8 single-item border-bottom"><strong>Vat ({{settings['vat_percent']}}%)</strong></div>
                        <div class="col-4 single-item border-bottom">{{settings.currency_symbol}}{{vatAmount}}</div>
                    </div>
                    <div class="row content-items-list border-0 pt-0">
                        <div class="col-8 single-item border-bottom"><strong>Payable Amount</strong></div>
                        <div class="col-4 single-item border-bottom">{{settings.currency_symbol}}{{totalAmount}}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shopping Cart Footer -->
        <div class="cart-footer">
            <div class="accordion shopping-special-code" id="shoppingExample">
                <div class="special-code-card">
                    <div id="shoppingHeading">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left toggle-special-code" type="button"
                                    data-toggle="collapse" data-target="#collapseCart" aria-expanded="false"
                                    aria-controls="collapseCart">
                                <span class="special-code-arrow-up">
                                    <i class="fa fa-chevron-circle-up mr-2" aria-hidden="true"></i>
                                </span>
                                <span class="special-code-arrow-down">
                                    <i class="fa fa-chevron-circle-down mr-2" aria-hidden="false"></i>
                                </span>
                                <span class="special-code-title">Have a coupon code?</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseCart" class="collapse" aria-labelledby="shoppingHeading" data-parent="#shoppingExample">
                        <div class="card-body">
                            <form class="special-code-form">
                                <input type="text" placeholder="Coupon Code..." class="special-input">
                                <input type="submit" name="special-go" value="Go" class="special-go">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Place Order Footer -->
            <div class="place-order-footer">
                <div class="row">
                    <div class="col pr-0">
                        <a class="btn btn-outline text-capitalize"
                           :class="!totalItems ? 'disabled': ''"
                           data-toggle="modal"
                           data-target="#Shipping"
                           @click.prevent="showShippingForm()">
                            <span class="mr-2">
                                <i class="fa fa-shipping-fast" aria-hidden="true"></i>
                            </span>
                            <span>Add Delivery Address</span>
                        </a>
                    </div>
                    <div class="col pl-0">
                        <a class="btn btn-outline text-capitalize"
                           @click.prevent="myShipping()"
                           :class="!totalItems ? 'disabled': ''">
                            <span class="mr-2">
                                <i class="fa fa-shipping-fast" aria-hidden="true"></i>
                            </span>
                            <span>My Delivery Address</span>
                        </a>
                    </div>
                </div>

                <a class="btn btn-outline text-capitalize"
                    :class="!totalItems || Object.keys(shippingDetails).length <= 0 || loader.button ? 'disabled': ''"
                    @click.prevent="placeOrder()">
                    <loading-component :loader="loader.button">
                        <span class="mr-2">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        </span>
                        <span>place order</span>
                    </loading-component>
                </a>
            </div>
        </div>
    </div>
    <modal-component v-if="modal.id === 'Shipping'">
        <shipping-form-component v-if="modal.id === 'Shipping'"></shipping-form-component>
    </modal-component>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
import ModalComponent from './modal.component';
import ShippingFormComponent from './shipping-form.component';
import LoadingComponent from './loading.component';
import * as Validator from "validatorjs";

export default {
    name: "cart.component",
    components: {
        ModalComponent,
        ShippingFormComponent,
        LoadingComponent,
    },
    computed: {
        ...mapState([
            'settings',
            'customer',
            'shoppingCart',
            'modal',
            'loader',
        ]),
        ...mapGetters([
            'isAuthenticated',
            'totalItems',
            'totalPrice',
            'totalQty',
            'totalDiscount',
            'totalVat',
            'totalSubTotal',
            'vatAmount',
            'totalAmount',
        ]),
        shippingDetails() {
            return {
                ...this.shoppingCart.shipping_details
            }
        }
    },
    created() {
        if (window.localStorage.getItem('shoppingCart')) {
            const shoppingCart = JSON.parse(atob(window.localStorage.getItem('shoppingCart')));
            this.$store.commit('setShoppingCart', shoppingCart);
            if (this.isAuthenticated) {
                this.$store.commit('setShoppingCart', { shipping_details: {...this.customer.details} });
            }
        }
    },
    methods: {
        deleteToCart(index) {
            if (_.get(this.shoppingCart, `items[${index}]`)) {
                this.$store.dispatch('deleteItemToCart', {index});
            }
        },
        updateToCart(event, index) {
            if (_.get(this.shoppingCart, `items[${index}]`)) {
                this.$store.dispatch('updateItemToCart', {index, qty: +event.target.value});
            }
        },
        clearCart() {
            this.$swal({
                title: this.getLang('common.are_you_sure'),
                text: this.getLang('common.clear_your_cart_as_empty'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: this.getLang('common.yes_clear'),
                cancelButtonText: this.getLang('common.no_cancel'),
                reverseButtons: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$store.commit('setShoppingCart', {
                        shipping_details: {},
                        items: [],
                    });
                } else {
                    this.$swal({
                        title: this.getLang('common.cancelled'),
                        text: this.getLang('common.your_cart_is_safe'),
                        icon: 'error',
                        timer: 1500,
                        showConfirmButton: false,
                    })
                }
            });
        },
        showShippingForm() {
            this.$store.commit('setModal', {
                id: 'Shipping',
                title: this.trans('add_delivery_address'),
                button: this.trans('submit'),
            });
            this.$store.commit('setFormInput', {
                ...this.shoppingCart.shipping_details
            });
        },
        myShipping() {
            if (this.isAuthenticated) {
                this.$store.commit('setShoppingCart', { shipping_details: {...this.customer.details} });
            } else {
                window.location.href = this.url('/login');
            }
        },
        placeOrder() {
            const rules = {
                full_name: 'required|min:3|max:45',
                email: 'required|email',
                mobile_no: 'required|max:45',
            };
            let validation = new Validator(this.shippingDetails, rules);
            if (validation.fails()) {
                this.showShippingForm();
                this.$store.commit('setErrorsAlert',  {
                    alert: null,
                    errors: validation.errors.all()
                });
                setTimeout(function() {
                    $('#Shipping').modal();
                }, 300);
            } else {
                this.$swal({
                    title: this.getLang('common.are_you_sure'),
                    text: this.getLang('common.place_your_order_now'),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: this.getLang('common.yes_order'),
                    cancelButtonText: this.getLang('common.no_cancel'),
                    reverseButtons: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$store.dispatch('placeOrder', {
                            order_status: 'placed',
                            payment_type: 'none',
                        });
                    }
                });
            }
        }
    }
}
</script>

<style scoped>
.shopping-cart {
    z-index: 1050;
}
.single-item{
    text-align: center;
    padding: 0px 3px 3px !important;
}
.content-items-list{
    height: auto!important;
    padding: 10px 0px;
    margin: 0px!important;
    font-size: 14px;
}
.content-title > div {
    padding: 0px;
}
</style>