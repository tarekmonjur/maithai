<template>
    <div id="homeCarouselIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
        <ol class="carousel-indicators">
            <li data-target="#homeCarouselIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#homeCarouselIndicators" data-slide-to="1"></li>
        </ol>
        <!---------- All Sliders Carousel's Here! --------->
        <div class="carousel-inner">
            <!----------- The Carousels First Item here ------------->
            <div class="carousel-item active">
                <section id="home-cover">
                    <div class="jumbotron">
                        <div class="dark-bg">
                            <div id="intro">
                                <div id="intro-section" class="mb-4">
                                    <!-- <h1 class="intro-title text-uppercase mb-4">
                                        mai thai
                                        <br>
                                        <span>
                                            <small class="small">kitchen</small>
                                        </span>
                                    </h1> -->
                                    <img class="mb-4 img img-fluid" :src="this.assetUrl('/logo/mai-thai-home-logo.png')" alt="MaiThai Kitchen" height="150" width="170">
                                    <h5 class="intro-info text-capitalize mb-3">find the best food, cafes & cuisine.
                                    </h5>
                                </div>
                                <div class="search-food mb-5">
                                    <input
                                        type="text"
                                        v-model="search_product"
                                        @keyup="this.searchProductHide()"
                                        @keyup.enter="this.searchProduct()"
                                        placeholder="Find Your Choice!" class="form-control">
                                    <button
                                        type="submit"
                                        @click.prevent="this.searchProduct()"
                                        @submit.prevent="this.searchProduct()"
                                        @keyup.enter="this.searchProduct()"
                                        class="btn btn-danger btn-custom text-uppercase">
                                        <i class="fas fa-search"></i>
                                        <span>Search</span>
                                    </button>
                                    <product-search-component v-if="show_search_product" className="search-dropdown-menu"></product-search-component>
                                </div>
                                <a :href="this.url('/about')" class="about-btn mt-4">About The Restaurant</a>
                                <a :href="this.url('/food-orders')" class="order-btn mt-4 ml-3">Order Food Online!</a>
                                <a :href="this.url('/contact')" class="order-btn mt-4 ml-3">Find Us!</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-------- Carousels 2nd Item here -------->
            <div class="carousel-item">
                <section id="home-cover-2">
                    <div class="jumbotron">
                        <div class="dark-bg">
                            <div id="intro">
                                <div id="intro-section" class="mb-4">
                                    <h1 class="intro-title home-slide-intro-2 mb-4" style="font-weight: 500; font-size: 50px;">
                                    <span style="font-weight: lighter;">
                                        "Short of screaming-hot Thai food,
                                    </span>
                                        <span class="text-light" style="font-weight: bold;">
                                        everything can be suitable for kids too"
                                    </span>
                                    </h1>
                                </div>

                                <a :href="this.url('/about')" class="about-btn mt-4">About The Restaurant</a>
                                <a :href="this.url('/food-orders')" class="order-btn mt-4 ml-3">Order Food Online!</a>
                                <a :href="this.url('/contact')" class="order-btn mt-4 ml-3">Find Us!</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- Carousel's Arrow Buttons for Next & Previous -->
        <a class="carousel-control-prev home-slide-prev" href="#homeCarouselIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next home-slide-next" href="#homeCarouselIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>

<script>
import ProductSearchComponent from './../common/product-search.component';

export default {
    name: "banner-slider.component",
    components: {
        ProductSearchComponent
    },
    data() {
        return {
            search_product: '',
            show_search_product: false,
        }
    },
    methods: {
        searchProductHide() {
            if (_.isEmpty(this.search_product)) {
                this.show_search_product = false;
            }
        },
        searchProduct() {
            if (_.isEmpty(this.search_product)) {
                this.show_search_product = false;
            } else {
                this.show_search_product = true;
                this.$store.dispatch('getSearchProducts', {params: {name: this.search_product}});
            }
        }
    }
}
</script>

<style scoped>

</style>