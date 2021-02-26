<template>
    <section id="gallery" class="jumbotron contact-jumbo mb-4">
            <div class="row mb-4">
                <div class="col-md-12 text-center mb-5 d-block" style="margin-bottom: 0 !important">
                    <h2 class="text-capitalize gellary-title section-title">Gallery</h2>
                    <p class="text-capitalize">check our restaurant and most popular Dishes</p>
                    <div class="underline mt-3 m-auto" style="border-bottom: 4px solid tomato; width: 5rem; padding-top: 15px;"></div>
                </div>
            </div>

            <div id="gallery_carousel" class="carousel slide" data-ride="carousel" data-interval="2000">
                <!-- Carousel One -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center cards-group">
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/mood-board.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/mar1.jpeg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma3.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/mar3.jpeg')" class="card-img-top card-img" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center cards-group">
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/mar4.jpeg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma1.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/1.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma2.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Two -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center cards-group">
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/mar5.jpeg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/2.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma4.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/3.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center cards-group">
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma5.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/4.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma6.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/mood-board.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center cards-group">
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma8.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/5.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma9.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                            <div class="card ml-2 mr-2 special-card">
                                <img :src="this.assetUrl('/img/gellary/ma10.jpg')" class="card-img-top card-img" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Buttons To Control -->
                <a class="carousel-control-prev offer-slide" href="#gallery_carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next offer-slide" href="#gallery_carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    </section>
</template>

<script>
export default {
    name: "gallery.component",
}
</script>

<style scoped>

</style>