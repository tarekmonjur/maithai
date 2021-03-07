<template>
    <app-component>
        <banner-component></banner-component>
        <content-component></content-component>
        <founder-component></founder-component>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import BannerComponent from './banner.component';
import ContentComponent from './content.component';
import FounderComponent from './founder.component';

export default {
    name: "about.component",
    components: {
        AppComponent,
        BannerComponent,
        ContentComponent,
        FounderComponent
    },
}
</script>

<style scoped>

</style>