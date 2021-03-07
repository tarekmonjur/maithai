<template>
    <section id="about-cover">
        <div class="jumbotron">
            <div class="about-text-section">
                <div class="about-cover text-light text-capitalize text-center">
                    <h1 class="display-3">about <br> {{settings.name}}</h1>
                    <p>{{settings.name}} is a Restaurant.</p>
                    <p>Come to explore the test of highest quality ingredients</p>
                    <p>while experiencing comfort through food you</p>
                    <p>never thought was possible.</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name: "banner.component",
    computed: {
        ...mapState(['settings'])
    },
}
</script>

<style scoped>

</style>