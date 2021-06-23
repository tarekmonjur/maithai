<template>
    <app-component>
        <banner-slider-component></banner-slider-component>
        <restaurant-gallery-component></restaurant-gallery-component>
        <product-gallery-component></product-gallery-component>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import BannerSliderComponent from './../common/banner-slider.component';
import RestaurantGalleryComponent from './restaurant-gallery.component';
import ProductGalleryComponent from './product-gallery.component';

export default {
    name: "gallery.component",
    components: {
        AppComponent,
        BannerSliderComponent,
        RestaurantGalleryComponent,
        ProductGalleryComponent
    }
}
</script>

<style scoped>

</style>