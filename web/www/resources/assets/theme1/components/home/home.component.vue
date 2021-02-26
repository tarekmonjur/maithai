<template>
    <app-component>
        <banner-slider-component></banner-slider-component>
        <welcome-component></welcome-component>
        <delivery-showcase-component></delivery-showcase-component>
        <product-showcase-component></product-showcase-component>
        <br>
        <lunch-showcase-component></lunch-showcase-component>
        <category-showcase-component></category-showcase-component>
        <hr>
        <contact-showcase-component></contact-showcase-component>
        <offer-showcase-component></offer-showcase-component>
        <gallery-component></gallery-component>
        <hr>
        <app-link-component></app-link-component>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import BannerSliderComponent from './banner-slider.component';
import DeliveryShowcaseComponent from './delivery-showcase.component';
import WelcomeComponent from './welcome.component';
import ProductShowcaseComponent from './product-showcase.component';
import CategoryShowcaseComponent from './category-showcase.component';
import OfferShowcaseComponent from './offer-showcase.component';
import LunchShowcaseComponent from './lunch-showcase.component';
import ContactShowcaseComponent from './../common/contact-showcase.component';
import GalleryComponent from './gallery.component';
import AppLinkComponent from './app-link.component';

export default {
    name: "home.component",
    components: {
        AppComponent,
        BannerSliderComponent,
        DeliveryShowcaseComponent,
        WelcomeComponent,
        ProductShowcaseComponent,
        CategoryShowcaseComponent,
        OfferShowcaseComponent,
        LunchShowcaseComponent,
        ContactShowcaseComponent,
        GalleryComponent,
        AppLinkComponent,
    }
}
</script>

<style scoped>

</style>