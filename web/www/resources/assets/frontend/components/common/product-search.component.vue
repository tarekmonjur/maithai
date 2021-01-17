<template>
    <ul :class="className">
        <li v-if="searchProduct.loader" class="search-item p-2">
            <loader-component :loader="searchProduct.loader" size="large"></loader-component>
        </li>
        <li class="search-item mt-2" v-else-if="searchProduct.data.length > 0" v-for="(product, index) in searchProduct.data">
            <a href="#">
                <div class="image">
                    <img :src="product.image ? product.image : this.assetUrl('/logo/logo.png')" alt="card1" class="search-bar-image">
                </div>
                <div class="nameAndPrice">
                    <div class="name">{{product.name}}</div>
                    <div class="price" v-if="product.special_price">{{product.special_price}}</div>
                    <div class="price" v-else>{{product.regular_price}}</div>
                </div>
            </a>
            <hr>
        </li>
        <li v-else class="search-item">
            <h5 class="p-2">No Product Found</h5>
        </li>
    </ul>
</template>

<script>
import LoaderComponent from './../common/loading.component';
import {mapState} from 'vuex';

export default {
    name: "product-search.component",
    props: ['className'],
    components: {
        LoaderComponent
    },
    computed: {
        ...mapState(['searchProduct'])
    }
}
</script>

<style scoped>

</style>