<template>
    <section id="gallery" class="food-gallery mt-5 container mobile-container maithai-bg">
        <div class="text-center mb-4 d-block">
            <h1 class="text-shadow our-food-style-title gallery-food-title">VIEW OUR RESTAURANT GALLERY!</h1>
            <div class="underline mt-2"></div>
        </div>

        <div class="tz-gallery justify-unset">
            <div class="row overflow-zero maithai-bg">
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/res1.jpeg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/res2.jpeg')" alt="">
                </div>

                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/res3.jpeg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/res4.jpeg')" alt="">
                </div>


                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/res5.jpeg')" alt="">
                </div>
                <div class="col-sm-4 col-md-4 width-unset overflow-zero">
                    <img class="tz-gallery-image gallery-only" :src="this.assetUrl('/gallery/res6.jpeg')" alt="">
                </div>
            </div>
        </div>
        <hr class="hr-disable">
    </section>
</template>

<script>
export default {
name: "restaurant-gallery.component"
}
</script>

<style scoped>

</style>