<template>
    <banner-slider-component></banner-slider-component>
    <welcome-component></welcome-component>
    <delivery-showcase-component></delivery-showcase-component>
    <product-showcase-component></product-showcase-component>
    <hr>
    <category-showcase-component></category-showcase-component>
    <offer-showcase-component></offer-showcase-component>
    <contact-showcase-component></contact-showcase-component>
    <hr>
    <br>
<!--    <gallery-component></gallery-component>-->
<!--    <hr>-->
    <app-link-component></app-link-component>
</template>

<script>
import BannerSliderComponent from './banner-slider.component';
import DeliveryShowcaseComponent from './delivery-showcase.component';
import WelcomeComponent from './welcome.component';
import ProductShowcaseComponent from './product-showcase.component';
import CategoryShowcaseComponent from './category-showcase.component';
import OfferShowcaseComponent from './offer-showcase.component';
import ContactShowcaseComponent from './contact-showcase.component';
import GalleryComponent from './gallery.component';
import AppLinkComponent from './app-link.component';

export default {
    name: "home.component",
    components: {
        BannerSliderComponent,
        DeliveryShowcaseComponent,
        WelcomeComponent,
        ProductShowcaseComponent,
        CategoryShowcaseComponent,
        OfferShowcaseComponent,
        ContactShowcaseComponent,
        GalleryComponent,
        AppLinkComponent,
    }
}
</script>

<style scoped>

</style>