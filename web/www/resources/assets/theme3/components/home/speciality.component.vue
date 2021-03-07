<template>
    <section class="speciality mt-5" id="speciality">

        <h1 class="text-shadow our-food-style-title">OUR SPECIALITY!</h1>
        <div class="underline mt-2"></div>

        <div class="box-container">

            <div class="box">
                <img :src="this.assetUrl('/img/img1.jpg')" alt="Food Menu">
                <div class="info">
                    <h3>Food Menu</h3>
                    <!-- <p>upto 25% discount</p> -->
                    <a target="_blank" :href="this.assetUrl('/menu/food-menu.pdf')" class="btn-maithai mt-4">Food Menu</a>
                </div>
            </div>

            <div class="box">
                <img :src="this.assetUrl('/img/img2.jpg')" alt="Lunch Menu">
                <div class="info">
                    <h3>Express Lunch Menu</h3>
                    <!-- <p>upto 20% discount</p> -->
                    <a target="_blank" :href="this.assetUrl('/menu/lunch-menu.pdf')" class="btn-maithai mt-4">Lunch Menu</a>
                </div>
            </div>

            <div class="box">
                <img :src="this.assetUrl('/img/img3.jpg')" alt="Dessert Menu">
                <div class="info">
                    <h3>Thai Dessert & Sweets</h3>
                    <!-- <p>upto 25% discount</p> -->
                    <a target="_blank" :href="this.assetUrl('/menu/drink-menu.pdf')" class="btn-maithai mt-4">Dessert Menu</a>
                </div>
            </div>

            <div class="box">
                <img :src="this.assetUrl('/img/img4.jpg')" alt="Take Away Menu">
                <div class="info">
                    <h3>Delicious Thai Takeaway</h3>
                    <!-- <p>upto 15% discount</p> -->
                    <a target="_blank" :href="this.assetUrl('/menu/takeaway-menu.pdf')" class="btn-maithai mt-4">Take Away Menu</a>
                </div>
            </div>

        </div>

        <div class="icons-container">

            <div class="icons">
                <i class="fas fa-shipping-fast"></i>
                <h3>fast delivery</h3>
            </div>

            <div class="icons">
                <i class="fas fa-tags"></i>
                <h3>heavy discounts</h3>
            </div>

            <div class="icons">
                <i class="fas fa-hand-holding-usd"></i>
                <h3>money returns</h3>
            </div>

            <div class="icons">
                <i class="fas fa-headset"></i>
                <h3>24 x 7 support</h3>
            </div>

        </div>

    </section>
</template>

<script>
export default {
    name: "speciality.component",
    data() {
        return {}
    }
}
</script>

<style scoped>

</style>