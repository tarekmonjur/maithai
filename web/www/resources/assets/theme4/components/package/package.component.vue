<template>
    <app-component>
        <product-banner-component></product-banner-component>
        <section id="food-list" class="mt-5 mb-5">
            <div class="container">
                <div class="food-list-header">
                    <h3 class="text-capitalize">food grids, combo food categories</h3>
                </div>
                <hr>
                <div class="food-list-body row">
                    <product-category-component
                        main-class="filter-item-food-package"
                        header-class="food-package">
                    </product-category-component>
                    <product-list-component></product-list-component>
                </div>
            </div>
        </section>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import ProductBannerComponent from './../common/product-banner.component';
import ProductCategoryComponent from './../common/product-category.component';
import ProductListComponent from './product-list.component';

export default {
    name: "product.component",
    components: {
        AppComponent,
        ProductBannerComponent,
        ProductCategoryComponent,
        ProductListComponent
    }
}
</script>

<style scoped>

</style>