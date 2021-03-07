<template>
    <section id="foodMenu" class="mt-5 mb-5" v-if="getCategories.length > 0">
        <div class="text-center mb-5 d-block">
            <h1 class="text-shadow section-title">Food Menu</h1>
            <div class="underline mt-2 title-underline"></div>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2000">
            <div class="carousel-inner container">
                <div class="row carousel-item food-menu-carousel" v-for="(category, index) in getCategories" :class="index === 0 ? 'active' : ''">
                    <div class="col-md-6 carousel-image">
                        <a :href="this.url('/food-orders/'+category.slug+'?cat='+category.id+'#products')">
                            <img :src="image ? image : category.image ? category.image : this.assetUrl('/logo/logo.png')"
                                 class="d-block img img-fluid img-offer food-image img-thumbnail p-0" :alt="category.name">
                        </a>
                    </div>
                    <div class="col-md-6 float-right text-dark food-menu-list">
                        <h1 class="text-uppercase display-2 text-shadow">
                            <a :href="this.url('/food-orders/'+category.slug+'?cat='+category.id+'#products')">
                                {{category.name}}
                            </a>
                        </h1>
                        <div class="d-flex offer-list" v-if="category.sub_categories">
                            <ul class="list-group list-group-flush offer-list-ul">
                                <li class="list-group-item"
                                    v-for="(subCategory, index) in subCategoryList1(category.sub_categories)">
                                    - <a @mouseover="image = subCategory.image" @mouseleave="image = null"
                                         :href="this.url('/food-orders/'+subCategory.slug+'?subcat='+subCategory.id+'#products')">{{subCategory.name}}</a>
                                </li>
                            </ul>
                            <ul class="list-group list-group-flush offer-list-ul">
                                <li class="list-group-item"
                                    v-for="(subCategory, index) in subCategoryList2(category.sub_categories)">
                                    - <a @mouseover="image = subCategory.image" @mouseleave="image = null"
                                         :href="this.url('/food-orders/'+subCategory.slug+'?subcat='+subCategory.id+'#products')">{{subCategory.name}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The Arrow Buttons For Next Previous -->
            <a class="ml-5 carousel-control-prev menu-btn" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="mr-5 carousel-control-next menu-btn" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</template>

<script>
import {mapState, mapGetters} from 'vuex';

export default {
    name: "category-showcase.component",
    data() {
      return {image: null}
    },
    computed: {
        ...mapState([
            'categories'
        ]),
        ...mapGetters([
            'getCategories'
        ]),
    },
    created() {
        const payload = {
            params: {
                is_active: 1,
                sublist: true,
            },
        };
        this.$store.dispatch('getCategories', payload);
    },
    methods: {
        subCategoryList1(items) {
            const count = !_.isEmpty(items) ? items.length : 0;
            const limit = Math.ceil(count / 2);
            return items.filter((item, index) => index < limit);
        },
        subCategoryList2(items) {
            const count = !_.isEmpty(items) ? items.length : 0;
            const limit = Math.ceil(count / 2);
            return items.filter((item, index) => index >= limit);
        },
    }
}
</script>

<style scoped>

</style>