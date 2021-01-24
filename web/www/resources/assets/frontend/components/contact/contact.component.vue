<template>
    <app-component>
        <banner-component></banner-component>
        <contact-form-component></contact-form-component>
        <br>
        <hr>
        <contact-showcase-component></contact-showcase-component>
        <hr>
        <div id="googleMap" class="map-container" style="overflow: hidden !important;">
            <div id="map" style="height: 500px; width: 100%; overflow: hidden !important;"></div>
        </div>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import BannerComponent from './banner.component';
import ContactShowcaseComponent from './../common/contact-showcase.component';
import ContactFormComponent from './contact-form.component';
import {mapState} from "vuex";

export default {
    name: "contact.component",
    components: {
        AppComponent,
        BannerComponent,
        ContactShowcaseComponent,
        ContactFormComponent
    },
    computed: {
        ...mapState(['settings'])
    },
}

fetch('https://maps.googleapis.com/maps/api/js?key=AIzaSyDtML-Aqf_jzSjvmI719z8OKabwtrWaW9Y&callback=initMap')
.then(response => {
    function initMap() {
        var location = {
            lat: 51.709474,
            lng: -0.036383
        };

        //Initialized map with latLng...
        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 20,
            center: location
        });

        //Fixed Marker for map on direction..
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
});

</script>

<style scoped>

</style>