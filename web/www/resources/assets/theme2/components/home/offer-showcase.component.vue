<template>
    <section class="jumbotron special-food-menu">
        <div class="dark-bg-opacity">
            <div class="container">
                <div class="carousel-title mb-5">
                    <h1 class="text-light no-margin-top text-center-sm text-center-xs">Special Offers</h1>
                </div>
            </div>
            <div id="offer_carousel" class="carousel slide" data-ride="carousel">
                <!-- Carousel One -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center cards-group">
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/mai2.jpg')" class="card-img-top card-img" alt="...">
                                <div class="card-body">
                                    <h3 class="card-title">Food Paradise</h3>
<!--                                    <p class="card-text text-muted">This is a wider card with supporting text below as a-->
<!--                                        natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                                    <h6 class="text-danger mt-2 font-weight-bold">About 20% Off</h6>-->
                                </div>
                            </div>

                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/mai3.jpg')" class="card-img-top card-img" alt="...">
                                <div class="card-body">
                                    <h3 class="card-title">Vanilla Food</h3>
<!--                                    <p class="card-text text-muted">This is a wider card with supporting text below as a-->
<!--                                        natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                                    <h6 class="text-danger mt-2 font-weight-bold">About 20% Off</h6>-->
                                </div>
                            </div>

                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/mai4.jpg')" class="card-img-top card-img" alt="...">
                                <div class="card-body">
                                    <h3 class="card-title">Food Basera</h3>
<!--                                    <p class="card-text text-muted">This is a wider card with supporting text below as a-->
<!--                                        natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                                    <h6 class="text-danger mt-2 font-weight-bold">About 50% Off</h6>-->
                                </div>
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/mai5.jpg')" class="card-img-top card-img" alt="...">
                                <div class="card-body">
                                    <h3 class="card-title">Thai Food</h3>
<!--                                    <p class="card-text text-muted">This is a wider card with supporting text below as a-->
<!--                                        natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                                    <h6 class="text-danger mt-2 font-weight-bold">About 30% Off</h6>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Two -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center cards-group">
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/mai6.jpg')" class="card-img-top card-img" alt="...">
                                <div class="card-body">
                                    <h3 class="card-title">Taj Mahal Food</h3>
<!--                                    <p class="card-text text-muted">This is a wider card with supporting text below as a-->
<!--                                        natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                                    <h6 class="text-danger mt-2 font-weight-bold">About 20% Off</h6>-->
                                </div>
                            </div>

                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/mai5.jpg')" class="card-img-top card-img" alt="...">
                                <div class="card-body">
                                    <h3 class="card-title">Indian Biriyani</h3>
<!--                                    <p class="card-text text-muted">This is a wider card with supporting text below as a-->
<!--                                        natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                                    <h6 class="text-danger mt-2 font-weight-bold">About 10% Off</h6>-->
                                </div>
                            </div>

                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/mai4.jpg')" class="card-img-top card-img" alt="...">
                                <div class="card-body">
                                    <h3 class="card-title">Green Bawarchi</h3>
<!--                                    <p class="card-text text-muted">This is a wider card with supporting text below as a-->
<!--                                        natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                                    <h6 class="text-danger mt-2 font-weight-bold">About 20% Off</h6>-->
                                </div>
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma8.jpg')" class="card-img-top card-img" alt="...">
                                <div class="card-body">
                                    <h3 class="card-title">Chineese</h3>
<!--                                    <p class="card-text text-muted">This is a wider card with supporting text below as a-->
<!--                                        natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                                    <h6 class="text-danger mt-2 font-weight-bold">About 5% Off</h6>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Buttons To Control -->
                <a class="carousel-control-prev offer-slide" href="#offer_carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next offer-slide" href="#offer_carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "offer-showcase.component"
}
</script>

<style scoped>

</style>