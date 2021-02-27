<template>
    <app-component>
        <banner-component></banner-component>
        <welcome-component></welcome-component>
        <br>
        <hr>
        <br>
        <content-component></content-component>
        <founder-component></founder-component>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import WelcomeComponent from './welcome.component';
import BannerComponent from './banner.component';
import ContentComponent from './content.component';
import FounderComponent from './founder.component';

export default {
    name: "about.component",
    components: {
        AppComponent,
        WelcomeComponent,
        BannerComponent,
        ContentComponent,
        FounderComponent
    },
}
</script>

<style scoped>

</style>