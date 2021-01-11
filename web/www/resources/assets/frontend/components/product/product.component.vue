<template>
    <product-banner-component></product-banner-component>
    <section id="food-list" class="mt-5 mb-5">
        <div class="container">
            <div class="food-list-header">
                <h3 class="text-capitalize">food grids, combo food categories</h3>
            </div>
            <hr>
            <div class="food-list-body row">
                <product-category-component
                    main-class="filter-item left-aside"
                    header-class="">
                </product-category-component>
                <product-list-component></product-list-component>
            </div>
        </div>
    </section>
</template>

<script>
import ProductBannerComponent from './../common/product-banner.component';
import ProductCategoryComponent from './../common/product-category.component';
import ProductListComponent from './product-list.component';

export default {
    name: "product.component",
    components: {
        ProductBannerComponent,
        ProductCategoryComponent,
        ProductListComponent
    }
}
</script>

<style scoped>

</style>