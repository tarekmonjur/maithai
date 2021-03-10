<template>
    <div class="container">
        <h1 class="text-shadow our-food-style-title food-menu-mobile-title">Items!</h1>
        <div class="underline mt-2"></div>
        <br>
        <hr>
    </div>

    <div class="container">
        <div class="mb-3" v-for="(category, cIndex) in getCategoryProducts" :id="'accordion'+cIndex">
            <div class="card">
                <div class="card-header collapse-header" :id="'heading'+cIndex">
                    <h6 class="text-capitalize toggle-click-4 mb-0"
                        @click="accordionIcon(cIndex)"
                        data-toggle="collapse"
                        :data-target="'#collapse'+cIndex"
                        aria-expanded="false"
                        :aria-controls="'collapse'+cIndex">
                        <span>
                            <img data-toggle="collapse" :data-target="'#collapse'+cIndex" :aria-controls="'collapse'+cIndex" v-if="accordion[cIndex]" :src="this.assetUrl('/icons/minus_collapse.png')" alt="-" width="20">
                            <img data-toggle="collapse" :data-target="'#collapse'+cIndex" :aria-controls="'collapse'+cIndex" v-else :src="this.assetUrl('/icons/plus_collapse.png')" alt="+" width="20">
                        </span>
                        <span class="ml-1">{{category.name}}</span>
                    </h6>
                </div>

                <div :id="'collapse'+cIndex"
                     class="collapse"
                     :class="{'show':showAccordion}"
                     :aria-labelledby="'heading'+cIndex"
                     :data-parent="'#accordion'+cIndex">
                    <div class="card-body collapse-body">
                        <div class="grid-area col-md-12 col-sm-8 col-xs-12">
                            <div class="row row-cols-1 row-cols-md-3">
                                <div class="col mb-4" v-for="(product, index) in category.products">
                                    <div class="card h-100">
                                        <a v-if="product.image" class="" href="javascript:void(0)" data-toggle="modal" data-target="#details" @click.prevent="showDetails(product)">
                                            <img :src="product.image" class="card-img-top img-thumbnail border-0" :alt="product.name">
                                        </a>
                                        <div class="card-body grid-body">
                                            <h5 class="card-title">
                                                <a class="" href="javascript:void(0)" data-toggle="modal" data-target="#details" @click.prevent="showDetails(product)">
                                                    {{product.name}}
                                                </a>
                                            </h5>
                                            <span class="card-vat">Vat: {{product.vat_percent}} %</span>
                                            <br>
                                            <div class="d-grid grid-footer text-center">
                                                <div class="discount-title">
                                                    <h6 class="text-danger" v-if="product.is_new == 1">New Food</h6>
                                                    <h6 class="text-danger" v-if="product.is_stock == 0">Stock Out</h6>
                                                    <h5 class="text-danger" v-if="+product.special_price > 0">
                                                        {{settings.currency_symbol}}{{product.special_price}} /
                                                        <del>{{settings.currency_symbol}}{{product.regular_price}}</del>
                                                    </h5>
                                                    <h5 class="text-danger" v-else>
                                                        {{settings.currency_symbol}}{{product.regular_price}}
                                                    </h5>
                                                </div>
                                                <hr v-if="product.description">
                                                <p class="text-muted mb-2 description">
                                                    {{getDescription(product.description)}}
                                                </p>
                                                <div class="grid-footer-btn mt-3">
                                                    <button
                                                        :disabled="loader[index] || product.is_stock == 0"
                                                        @click="addToCart(index, product.id)"
                                                        class="btn btn-custom text-capitalize">
                                                        <loader-component :loader="loader[index]">
                                                            <i class="fas fa-plus-circle"></i>
                                                            &nbsp;<span>add to cart</span>
                                                        </loader-component>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <modal-component v-if="modal.id === 'details'">
        <product-details-component :details="details"></product-details-component>
    </modal-component>
</template>

<script>
import {mapGetters, mapState} from 'vuex';
import LoaderComponent from './../common/loading.component';
import ModalComponent from './../common/modal.component';
import ProductDetailsComponent from './../common/product-details.component';

export default {
    name: "product-list.component",
    components: {
        LoaderComponent,
        ModalComponent,
        ProductDetailsComponent
    },
    data() {
        return {
            loader: [],
            details: {},
            accordion: [],
        }
    },
    computed: {
        ...mapState([
            'products',
            'settings',
            'modal',
            'filters'
        ]),
        ...mapGetters([
            'getProducts',
        ]),
        showAccordion() {
            if (_.get(this.filters, 'name')) {
                return true;
            }
            return false;
        },
        getCategoryProducts() {
            const categories = [];
            let products = this.getProducts;
            if (_.get(this.filters, 'name')) {
                products = _.compact(_.map(products, product => {
                    const regx = new RegExp(_.get(this.filters, 'name', '').toLowerCase()+".*$");
                    if (product.name && product.name.toLowerCase().match(regx)) {
                        return product;
                    }
                    if (product.category && product.category.name.toLowerCase().match(regx)) {
                        return product;
                    }
                    if (product.sub_category && product.sub_category.name.toLowerCase().match(regx)) {
                        return product;
                    }
                }));
            }

            if (!_.isEmpty(products)) {
                products.forEach(product => {
                    if (product.sub_category) {
                        const findCat = categories.findIndex(item => item.slug === product.sub_category.slug);

                        if (findCat > -1) {
                            categories[findCat].products.push(product);
                        } else {
                            categories.push({
                                ...product.sub_category,
                                products: [product]
                            });
                        }
                    } else if (product.category) {
                        const findCat = categories.findIndex(item => item.slug === product.category.slug);

                        if (findCat > -1) {
                            categories[findCat].products.push(product);
                        } else {
                            categories.push({
                                ...product.category,
                                products: [product]
                            });
                        }
                    }
                })
            }
            return categories;
        }
    },
    created() {
        const url = new URL(window.location.href);
        const paths = url.pathname.split('/');
        const slug = paths.pop();
        const category_id = url.searchParams.get('cat');
        const sub_category_id = url.searchParams.get('subcat');
        let cat_ids = [];
        let sub_ids = [];
        if (!isNaN(parseInt(category_id))) {
            cat_ids.push(category_id);
        }
        if (!isNaN(parseInt(sub_category_id))) {
            sub_ids.push(sub_category_id);
        }
        const payload = {
            params: {
                category_id: cat_ids,
                sub_category_id: sub_ids,
                paginate: false,
            }
        };
        this.$store.dispatch('getProducts', payload);
    },
    methods: {
        getDescription(text) {
            const words = _.words(text);
            return words.length > 15 ?
                words.splice(0, 15).join(' ')+' ...' : text;

        },
        async addToCart(index, product_id) {
            if (product_id) {
                this.loader[index] = true;
                const payload = {
                    product_id
                }
                await this.$store.dispatch('addItemToCart', payload);
                this.loader[index] = false;
            }
        },
        showDetails(product) {
            this.$store.commit('setModal', {
                id: 'details',
                title: this.trans('product_details'),
                button: false,
            });
            this.details = product;
        },
        accordionIcon(index) {
            this.accordion[index] = !this.accordion[index];
        },
    }
}
</script>

<style scoped>
.description{
    font-size: 14px;
}
.card-body a {
    text-decoration: none;
}
</style>