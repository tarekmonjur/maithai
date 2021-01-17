<template>
    <section class="subcription mt-5">
        <div class="container">
            <div class="row">
                <!-- Col-1 -->
                <div class="col-md-3 col-xs-12 col-md-offset-1 col-md-pull-8 mr-5">
                    <div class="newsletters-phone">
                        <img :src="this.assetUrl('/logo/mobile.png')" alt="Mobilee">
                    </div>
                </div>
                <!-- Col-2 -->
                <div class="col-md-8 col-xs-12 col-md-push-4 ml-4">
                    <div class="mt-5 subcription-to-phone-only">
                        <h2>The Best MAITHAI KITCHEN Delivery App!</h2>
                        <h5 class="mt-4">Download our free iOS, Windows phone and Android App and order food online the
                            fastest way possible.</h5>

                        <!-- Buttons For Android, Apple, Microsoft -->
                        <div class="d-flex mt-4">
                            <a href="https://apps.apple.com/in/app/mai-thai/id1524480953">
                                <img :src="this.assetUrl('/logo/apple-badge.png')" alt="Download on app store" class="img img-fluid"></a>

                            <a href="https://play.google.com/store/apps/details?id=com.eposhybrid.maithai&gl=GB" class="ml-4">
                                <img :src="this.assetUrl('/logo/google-play-badge.png')" alt="Get it on Google Play" class="img img-fluid"></a>

                            <!-- <a href="#" class="ml-4"><img src="assets/logo/windows-badge.png"
                                    alt="Download from windows phone store" class="img img-fluid"></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "app-link.component"
}
</script>

<style scoped>

</style>