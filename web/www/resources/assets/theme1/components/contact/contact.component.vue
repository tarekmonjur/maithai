<template>
    <app-component>
        <banner-component></banner-component>
        <contact-form-component></contact-form-component>
        <br>
        <hr>
        <contact-showcase-component></contact-showcase-component>
        <hr>
        <div id="googleMap" class="map-container" style="overflow: hidden !important;">
            <google-map-component
                :config="mapConfigs"
            />
        </div>
    </app-component>
</template>

<script>
import {mapState} from "vuex";
import AppComponent from './../app.component';
import BannerComponent from './banner.component';
import ContactShowcaseComponent from './../common/contact-showcase.component';
import ContactFormComponent from './contact-form.component';
import GoogleMapComponent from './../common/maps/google-map.component';

export default {
    name: "contact.component",
    components: {
        AppComponent,
        BannerComponent,
        ContactShowcaseComponent,
        ContactFormComponent,
        GoogleMapComponent
    },
    computed: {
        ...mapState(['settings']),
        mapConfigs() {
            return {
                position: {
                    lat: 51.71005503040437,
                    lng: -0.03449472482283282,
                }
            }
        }
    },
}

</script>

<style scoped>

</style>