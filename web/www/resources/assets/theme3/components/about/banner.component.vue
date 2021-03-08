<template>
    <section id="about-cover">
        <div class="jumbotron">
            <div class="about-text-section">
                <div class="about-cover text-light text-capitalize text-center">
                    <h1 class="display-3">about <br> {{settings.name}}</h1>
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