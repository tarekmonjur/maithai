<template>
    <section class="jumbotron contact-jumbo mb-4">
        <div class="">
            <div class="row">
                <div class="col-md-12 text-center mb-5 d-block" style="margin-bottom: 0 !important">
                    <h2 class="text-capitalize gellary-title section-title">Gallery</h2>
                    <p class="text-capitalize">check gallery for our most popular dishes</p>
                    <div class="underline mt-3 m-auto" style="border-bottom: 4px solid tomato; width: 5rem; padding-top: 15px;"></div>
                </div>
            </div>

            <div class="row text-center" style="overflow: unset !important;">
                <div class="slideGellary hi-slide" style="overflow: unset !important;">
                    <!-- Next & Previos Buttons -->
                    <a class="hi-prev carousel-control-prev" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="hi-next carousel-control-next" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <ul>
                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma1.jpg')" alt="Img 1" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma2.jpg')" alt="Img 2" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma3.jpg')" alt="Img 3" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma4.jpg')" alt="Img 4" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma5.jpg')" alt="Img 5" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma6.jpg')" alt="Img 6" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma7.jpg')" alt="Img 7" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma8.jpg')" alt="Img 8" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma9.jpg')" alt="Img 9" />
                        </li>

                        <li>
                            <img class="img-fluid" :src="this.assetUrl('/img/gellary/ma10.jpg')" alt="Img 10" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "gallery.component"
}
</script>

<style scoped>

</style>