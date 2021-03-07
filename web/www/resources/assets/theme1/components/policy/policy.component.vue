<template>
    <app-component>
        <banner-component></banner-component>
        <content-component></content-component>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import BannerComponent from './banner.component';
import ContentComponent from './content.component';

export default {
    name: "policy.component",
    components: {
        AppComponent,
        BannerComponent,
        ContentComponent
    },
}
</script>

<style scoped>

</style>