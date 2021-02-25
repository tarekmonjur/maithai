<template>
    <section class="jumbotron special-lunch-menu">
        <div class="dark-bg-opacity">
            <div class="container">
                <div class="carousel-title mb-5">
                    <h1 class="text-light no-margin-top text-center-sm text-center-xs">Lunch Menu</h1>
                </div>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <!-- Carousel One -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center cards-group">
                                <img :src="this.assetUrl('/img/lunch/1.jpg')" class="card-img-top" alt="...">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center cards-group">
                            <img :src="this.assetUrl('/img/lunch/2.jpg')" class="card-img-top" alt="...">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center cards-group">
                            <img :src="this.assetUrl('/img/lunch/3.jpg')" class="card-img-top" alt="...">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center cards-group">
                            <img :src="this.assetUrl('/img/lunch/4.jpg')" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
                <!-- Carousel Buttons To Control -->
                <a class="carousel-control-prev offer-slide" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next offer-slide" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "lunch-showcase.component"
}
</script>

<style scoped>
@media only screen and (min-width: 720px) {
    .card-img-top {
        width: 50%;
    }
}
</style>