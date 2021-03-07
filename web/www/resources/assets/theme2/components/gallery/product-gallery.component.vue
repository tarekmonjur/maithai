<template>
    <section id="gallery" class="food-gallery mt-5 container mobile-container maithai-bg-2">
        <div class="text-center mb-4 d-block">
            <h1 class="text-shadow our-food-style-title gallery-food-title">VIEW OUR FOOD GALLERY!</h1>
            <div class="underline mt-2"></div>
        </div>

        <div class="tz-gallery justify-unset">
            <div class="row overflow-zero">
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma1.jpg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma2.jpg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma3.jpg')" alt="">
                </div>

                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma4.jpg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma5.jpg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma6.jpg')" alt="">
                </div>

                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma7.jpg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma8.jpg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/ma9.jpg')" alt="">
                </div>

                <div></div>

            </div>
        </div>
    </section>
</template>

<script>
export default {
name: "restaurant-gallery.component"
}
</script>

<style scoped>

</style>