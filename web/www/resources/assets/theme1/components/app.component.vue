<template>
    <header-component></header-component>
    <navbar-component></navbar-component>
    <slot></slot>
    <footer-component></footer-component>
    <cart-component></cart-component>
    <alert-component></alert-component>
</template>

<script>
import HeaderComponent from './common/header.component';
import NavbarComponent from './common/navbar.component';
import FooterComponent from './common/footer.component';
import CartComponent from './common/cart.component';
import AlertComponent from './common/alert.component';

export default {
    name: "app.component",
    components: {
        HeaderComponent,
        NavbarComponent,
        FooterComponent,
        CartComponent,
        AlertComponent,
    },
    created() {
        this.$store.dispatch('init');
    },
}
</script>

<style scoped>

</style>