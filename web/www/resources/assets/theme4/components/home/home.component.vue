<template>
    <app-component>
        <banner-slider-component></banner-slider-component>
        <gallery-component></gallery-component>
        <hr>
        <speciality-component></speciality-component>
        <hr>
        <dish-component></dish-component>
        <hr>
        <product-showcase-component></product-showcase-component>
        <br>
        <hr>
        <app-link-component></app-link-component>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import BannerSliderComponent from './../common/banner-slider.component';
import ProductShowcaseComponent from './product-showcase.component';
import GalleryComponent from './gallery.component';
import SpecialityComponent from './speciality.component';
import DishComponent from './dish.component';
import AppLinkComponent from './app-link.component';

export default {
    name: "home.component",
    components: {
        AppComponent,
        BannerSliderComponent,
        ProductShowcaseComponent,
        GalleryComponent,
        SpecialityComponent,
        DishComponent,
        AppLinkComponent,
    }
}
</script>

<style scoped>

</style>