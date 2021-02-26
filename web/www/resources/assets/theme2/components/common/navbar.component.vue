<template>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <button class="navbar-toggler m-1" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span> Options </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link" :href="this.url()">home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="this.url('/food-orders')">food order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="this.url('/food-package')">food package</a>
                    </li>
                    <li class="nav-item">
                        <a v-if="!isAuthenticated" class="nav-link" :href="this.url('/login')">login & register</a>
                        <a v-else class="nav-link" :href="this.url('/my-orders')">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="this.url('/about')">about us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="this.url('/contact')">contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="this.url('/terms-policy')">terms & policy</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "navbar.component",
    computed: {
        ...mapGetters([
            'isAuthenticated',
        ])
    }
}
</script>

<style scoped>

</style>