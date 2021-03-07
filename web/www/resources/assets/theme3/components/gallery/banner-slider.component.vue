<template>
    <div id="homeCarouselIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
        <ol class="carousel-indicators">
            <li data-target="#homeCarouselIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#homeCarouselIndicators" data-slide-to="1"></li>
            <li data-target="#homeCarouselIndicators" data-slide-to="2"></li>
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
                                    <img class="mb-4 mt-4 img img-fluid" :src="this.assetUrl('/logo/mai-thai-png-logo.png')" alt="MaiThai Kitchen" height="150" width="170">
                                    <h5 class="intro-info text-capitalize mb-3">find the best food, cafes & cuisine.
                                    </h5>
                                </div>
                                <a href="#orderFoods" class="order-btn mt-4">Order Food!</a>
                                <a href="#speciality" class="order-btn mt-4 ml-3">Food Menu!</a>
                                <a :href="this.url('/about')" class="order-btn mt-4 ml-3">About Us!</a>
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

                                <a href="#orderFoods" class="order-btn mt-4">Order Food!</a>
                                <a href="#speciality" class="order-btn mt-4 ml-3">Food Menu!</a>
                                <a :href="this.url('/about')" class="order-btn mt-4 ml-3">About Us!</a>
                                <a :href="this.url('/contact')" class="order-btn mt-4 ml-3">Find Us!</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-------- Carousels 4th Item here -------->
            <div class="carousel-item">
                <section id="home-cover-4">
                    <div class="jumbotron">
                        <div class="dark-bg">
                            <div id="intro">
                                <a href="#orderFoods" class="order-btn mt-4">Order Food!</a>
                                <a href="#speciality" class="order-btn mt-4 ml-3">Food Menu!</a>
                                <a :href="this.url('/about')" class="order-btn mt-4 ml-3">About Us!</a>
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
    }
}
</script>

<style scoped>

</style>