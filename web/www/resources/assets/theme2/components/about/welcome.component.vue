<template>
    <section class="container mb-4">
        <div class="mt-5 row">
            <!-- Aside LeftSide -->
            <aside class="col-md-6 text-center">
                <div class="card border-0">
                    <div class="card-body">
                        <h1 class="card-title text-capitalize m-4">welcome to {{settings.name}}</h1>
                        <br>
                        <h6 class="card-subtitle mb-2">Get Best, Feel Happy!</h6>
                        <br>
                        <p class="card-text text-muted" style="font-size: 13px; word-spacing: 2px; letter-spacing: 0.5px; ">{{settings.name}} Delivers
                            Deliciously Authentic Thai Mai Kitchen & an atmosphere that is friendly and fun for the
                            whole family. Our authentic Thai Mai Menu balances elements of sweet and sour, salt and
                            spice to bring the best Thai Flavours
                            to your Table. Prepared by experienced Thai Chefs, We offer a range of dishes from the
                            classic Pad Thai to Authentic Thai curries.</p>
                    </div>
                </div>
            </aside>

            <!-- Aside RightSide -->
            <aside class="col-md-6">
                <img :src="this.assetUrl('/img/mood-board.jpg')" alt="" class="img img-fluid" style="min-height: 380px">
            </aside>
        </div>
    </section>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "welcome.component",
    computed: {
        ...mapState(['settings'])
    },
}
</script>

<style scoped>

</style>