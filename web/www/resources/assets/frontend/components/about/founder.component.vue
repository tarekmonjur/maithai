<template>
    <section id="about-founders">
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-capitalize text-center display-4 mb-5">founder of {{settings.name}}</h1>
                    </div>
                </div>

                <div class="row">
                    <!-- Col-1 -->
                    <div class="col-md-4">
                        <div class="image middle">
                            <img :src="this.assetUrl('/img/founder.jpg')" alt="" class="img img-fluid img-thumbnail">
                            <!-------------The Image-Content Area------------->
                            <!-- Founders Hover Social Icons Here -->
                            <!-- <div class="image-content">
                                    <div class="icons">
                                      <a href="#" class="icon fab fa-facebook"></a>
                                      <a href="#" class="icon fab fa-twitter"></a>
                                      <a href="#" class="icon fab fa-instagram"></a>
                                    </div>
                                  </div> -->
                        </div>
                    </div>

                    <!-- Col-2 -->
                    <div class="col-md-8">
                        <div class="image-title content">
                            <p class="text-capitalize">founder</p>
                            <div class="underline-hr"></div>
                            <p class="text-body-muted founders-some-talk-text">
                                I Moved from BURIRAM to UK 2008. When I Focus on Thai Restaurant i try to maintain Proper Service and
                                Well Food and also Dream to open own Thai cuisine. I'm food lover, Chef, and Tradeswoman. I was
                                looking for open up my own shop for a while Excited got an opportunity to open at CHESHUNT, Broxbourne
                                And Mai Thai Kitchen. I'm Super Excited to meet all my new customers and working with them
                                Tasty's great Meal. By the way, All my customers are important to me, i like to know thier thought,
                                Feedback and Suggestion. Please Don't Hesitate to let us know.
                                Regards
                                BEE
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "founder.component",
    computed: {
        ...mapState(['settings'])
    },
}
</script>

<style scoped>

</style>