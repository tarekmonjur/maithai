<template>
    <section class="dish mt-5" id="dish">

        <h1 class="text-shadow our-food-style-title">POPULAR DISHES!</h1>
        <div class="underline mt-2"></div>

        <ul class="controls">
            <li class="buttons button-active" data-filter="all">All</li>
            <li class="buttons" data-filter="thai">Thai</li>
            <li class="buttons" data-filter="soup">Soup</li>
            <li class="buttons" data-filter="juice">Juice</li>
            <li class="buttons" data-filter="prawn">Prawn</li>
        </ul>

        <div class="image-container">

            <div class="image soup">
                <img :src="this.assetUrl('/img/thai-2.jpg')" alt="">
            </div>
            <div class="image soup">
                <img :src="this.assetUrl('/img/thai-7.jpg')" alt="">
            </div>
            <div class="image soup">
                <img :src="this.assetUrl('/img/thai-9.jpg')" alt="">
            </div>

            <div class="image thai">
                <img :src="this.assetUrl('/img/thai-8.jpg')" alt="">
            </div>
            <div class="image thai">
                <img :src="this.assetUrl('/img/thai-1.jpg')" alt="">
            </div>
            <div class="image thai">
                <img :src="this.assetUrl('/img/thai-4.jpg')" alt="">
            </div>

            <div class="image juice">
                <img :src="this.assetUrl('/img/juice1.jpg')" alt="">
            </div>
            <div class="image juice">
                <img :src="this.assetUrl('/img/juice2.jpg')" alt="">
            </div>

            <div class="image prawn">
                <img :src="this.assetUrl('/img/thai-5.jpg')" alt="">
            </div>

        </div>

    </section>
</template>

<script>
export default {
    name: "dish.component",
    data() {
        return {}
    }
}
</script>

<style scoped>

</style>