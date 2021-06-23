<template>
    <div id="homeCarouselIndicators" class="carousel slide" data-ride="carousel" data-interval="1500">
        <!--        <ol class="carousel-indicators">-->
        <!--            <li data-target="#homeCarouselIndicators" data-slide-to="0" class="active"></li>-->
        <!--            <li data-target="#homeCarouselIndicators" data-slide-to="1"></li>-->
        <!--            <li data-target="#homeCarouselIndicators" data-slide-to="2"></li>-->
        <!--            <li data-target="#homeCarouselIndicators" data-slide-to="3"></li>-->
        <!--        </ol>-->
        <!---------- All Sliders Carousel's Here! --------->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="slide-img">
                    <img :src="this.assetUrl('/slide/maithai-1.jpg')" />
                </div>
            </div>
            <div class="carousel-item">
                <div class="slide-img">
                    <img :src="this.assetUrl('/slide/maithai-3.jpeg')" />
                </div>
            </div>
            <div class="carousel-item">
                <div class="slide-img">
                    <img :src="this.assetUrl('/slide/food1.jpg')" />
                </div>
            </div>
            <div class="carousel-item">
                <div class="slide-img">
                    <img :src="this.assetUrl('/slide/maithai-2.jpg')" />
                </div>
            </div>
            <div class="carousel-item">
                <div class="slide-img">
                    <img :src="this.assetUrl('/slide/maithai.jpeg')" />
                </div>
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

export default {
    name: "banner-slider.component",
}
</script>

<style scoped>
.slide-img{
    width: 100%;
    height: 800px;
    overflow: hidden;
    border-radius: 0 !important;
    margin-bottom: 0 !important;
}
.slide-img > img {
    width: 100%;
    height: 100%;
    background-size: cover;
}

@media screen and (max-width: 765px) {
    .slide-img {
        height: 100%;
    }
}

</style>