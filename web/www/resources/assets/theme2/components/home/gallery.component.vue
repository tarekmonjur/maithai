<template>
    <!--------------- Gellary Show Section --------------->
    <section class="mobile-container maithai-bg p-0">
        <div class="text-center mt-5 mb-4 d-block">
            <h1 class="text-shadow our-food-style-title gallery-food-title">GREAT FOOD GALLERY!</h1>
            <div class="underline mt-2"></div>
        </div>

        <div class="tz-gallery justify-unset">
            <div class="row overflow-zero">
                <div class="col-sm-6 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-1.jpg')" alt="Park">
                </div>
                <div class="col-sm-6 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-2.jpg')" alt="Park">
                </div>
                <div class="col-sm-12 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-3.jpg')" alt="Park">
                </div>
                <div class="col-sm-6 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-4.jpg')" alt="Park">
                </div>
                <div class="col-sm-6 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-5.jpg')" alt="Park">
                </div>
                <div class="col-sm-6 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-6.jpg')" alt="Park">
                </div>
                <div class="col-sm-6 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-7.jpg')" alt="Park">
                </div>
                <div class="col-sm-6 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-8.jpg')" alt="Park">
                </div>
                <div class="col-sm-6 col-md-4 overflow-zero width-unset">
                    <img class="tz-gallery-image" :src="this.assetUrl('/img/thai-9.jpg')" alt="Park">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "gallery.component",
    data() {
        return {}
    }
}
</script>

<style scoped>

</style>