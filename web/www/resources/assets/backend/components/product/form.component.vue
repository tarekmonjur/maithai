<template>
    <form name="">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="name">{{lang('name')}} : <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="name"
                        @keyup="this.slug"
                        v-model="formInput['name']"
                        :class="{'is-invalid' : errors.name}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.name">{{errors.name}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="slug">{{lang('slug')}} : <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="slug"
                        v-model="formInput['slug']"
                        :class="{'is-invalid' : errors.slug}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.slug">{{errors.slug}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="code">{{lang('code')}} :</label>
                    <input
                        type="text"
                        id="code"
                        v-model="formInput['code']"
                        :class="{'is-invalid' : errors.code}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.code">{{errors.code}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="barcode">{{lang('barcode')}} :</label>
                    <input
                        type="text"
                        id="barcode"
                        v-model="formInput['barcode']"
                        :class="{'is-invalid' : errors.barcode}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.barcode">{{errors.barcode}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sorting">{{lang('sorting')}} : </label>
                    <input
                        type="text"
                        id="sorting"
                        v-model="formInput['sort']"
                        :class="{'is-invalid' : errors.sort}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.sort">{{errors.sort}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="unit_id">{{lang('unit')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['unit_id']"
                        :class="{'is-invalid' : errors.unit_id}"
                        id="unit_id">
                        <option v-for="unit in units" :value="unit.id">{{unit.name}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.unit_id">{{errors.unit_id}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="category_id">{{lang('category')}} :<span class="text-danger">*</span></label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['category_id']"
                        @change="getSubCategories($event.target.value)"
                        :class="{'is-invalid' : errors.category_id}"
                        id="category_id">
                        <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.category_id">{{errors.category_id}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sub_category_id">{{lang('sub_category')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['sub_category_id']"
                        :class="{'is-invalid' : errors.name}"
                        id="sub_category_id">
                        <option v-for="category in subCategories" :value="category.id">{{category.name}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.sub_category_id">{{errors.sub_category_id}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="regular_price">{{lang('regular_price')}} : <span class="text-danger">*</span></label>
                    <input
                        type="number"
                        id="regular_price"
                        v-model="formInput['regular_price']"
                        :class="{'is-invalid' : errors.regular_price}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.regular_price">{{errors.regular_price}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="special_price">{{lang('special_price')}} : </label>
                    <input
                        type="number"
                        id="special_price"
                        v-model="formInput['special_price']"
                        :class="{'is-invalid' : errors.special_price}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.special_price">{{errors.special_price}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="vat_percent">{{lang('vat_percent')}} : </label>
                    <input
                        type="text"
                        id="vat_percent"
                        v-model="formInput['vat_percent']"
                        :class="{'is-invalid' : errors.vat_percent}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.vat_percent">{{errors.vat_percent}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="is_stock">{{lang('is_stock')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['is_stock']"
                        id="is_stock">
                        <option value="1">{{lang('available')}}</option>
                        <option value="0">{{lang('not_available')}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.is_stock">{{errors.is_stock}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="is_package">{{lang('is_package')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['is_package']"
                        id="is_package">
                        <option value="1">{{lang('yes')}}</option>
                        <option value="0">{{lang('no')}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.is_package">{{errors.is_package}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="is_active">{{lang('is_active')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['is_active']"
                        id="is_active">
                        <option value="1">{{lang('active')}}</option>
                        <option value="0">{{lang('inactive')}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.is_active">{{errors.is_active}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="is_new">{{lang('is_new')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['is_new']"
                        id="is_new">
                        <option value="1">{{lang('yes')}}</option>
                        <option value="0">{{lang('no')}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.is_new">{{errors.is_new}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div>
                    <label>{{lang('variants')}} :</label>
                    <button-component
                        class="float-right"
                        :btn="{name: 'variant.add', icon: 'plus'}"
                        :action="this.addNewVariant">
                    </button-component>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>{{lang('variant')}}</td>
                            <td>{{lang('sub_variant')}}</td>
                            <td>{{lang('additional_price')}}</td>
                            <td>{{lang('action')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(variant, index) in formInput['variants']">
                            <td>
                                <select
                                    class="form-control form-control-sm"
                                    v-model="formInput['variants'][index]['variant_id']"
                                    @change="getSubVariants($event.target.value, index)">
                                    <option v-for="variant in variants" :value="variant.id">{{variant.name}}</option>
                                </select>
                            </td>
                            <td>
                                <select
                                    class="form-control form-control-sm"
                                    v-model="formInput['variants'][index]['sub_variant_id']">
                                    <option v-for="variant in subVariants[index]" :value="variant.id">{{variant.name}}</option>
                                </select>
                            </td>
                            <td>
                                <input
                                    type="number"
                                    v-model="formInput['variants'][index]['price']"
                                    class="form-control form-control-sm" />
                            </td>
                            <td width="100">
                                <button-component
                                    :btn="{icon: 'trash'}"
                                    :action="(btn) => this.deleteVariant(index)">
                                </button-component>
                                <input type="hidden" v-model="formInput['variants'][index]['id']">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="col">
                <div>
                    <label>{{lang('stock&sku')}} :</label>
                    <button-component
                        class="float-right"
                        :btn="{name: 'sku.add', icon: 'plus'}"
                        :action="this.addNewStock">
                    </button-component>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>{{lang('sku')}}</td>
                        <td>{{lang('stock')}}</td>
                        <td>{{lang('action')}}</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(stock, index) in formInput['stocks']">
                        <td>
                            <select
                                class="form-control form-control-sm"
                                v-model="formInput['stocks'][index]['sku_id']">
                                <option v-for="sku in skus" :value="sku.id">{{sku.name}}</option>
                            </select>
                        </td>
                        <td>
                            <input
                                type="number"
                                v-model="formInput['stocks'][index]['stock']"
                                @keyup="updateStock()"
                                class="form-control form-control-sm" />
                        </td>
                        <td width="100">
                            <button-component
                                :btn="{icon: 'trash'}"
                                :action="(btn) => this.deleteStock(index)">
                            </button-component>
                            <input type="hidden" v-model="formInput['stocks'][index]['id']">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="stock">{{lang('stock')}} : </label>
                    <input
                        type="number"
                        id="stock"
                        v-model="formInput['stock']"
                        :class="{'is-invalid' : errors.stock}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.stock">{{errors.stock}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="image">{{lang('image')}} :</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        @change="filesBrowse($event)"
                        :class="{'is-invalid' : errors.image}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.image">{{errors.image}}</div>
                </div>
            </div>
            <div class="col" v-if="formInput['image']">
                <div class="form-group">
                    <br>
                    <img :src="formInput['image']" alt="" width="60">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="description">{{lang('description')}} :</label>
                    <textarea
                        id="description"
                        v-model="formInput['description']"
                        :class="{'is-invalid' : errors.description}"
                        class="form-control form-control-sm"></textarea>
                    <div class="invalid-feedback" v-if="errors.description">{{errors.description}}</div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import {mapState, mapGetters} from "vuex";
import ButtonComponent from './../common/button.component';

export default {
    name: "form.component",
    components: {ButtonComponent},
    computed: {
        ...mapState([
            'lang_key',
            'formInput',
            'errors',
        ]),
        ...mapGetters([
            'categories',
            'subCategories',
            'units',
            'variants',
            'subVariants',
            'skus',
        ]),
    },
    methods: {
        lang(key) {
            return this.getLang(`${this.lang_key}.${key}`);
        },
        slug() {
           _.set(
               this.formInput,
               'slug',
               this.toSlug(_.get(this.formInput, 'name', ''))
               );
        },
        filesBrowse(event) {
            const files_name = event.target.name;
            const files = event.target.files;
            this.formInput[files_name] = files[0];
        },
        async getSubCategories(id) {
            this.$store.dispatch('getSubCategories', {id});
        },
        async getSubVariants(id, index) {
            this.$store.dispatch('getSubVariants', {id, index});
        },
        addNewVariant(btn) {
            if (!this.formInput['variants'] || _.isEmpty(this.formInput['variants'])) {
                this.formInput['variants'] = [];
            }

            this.formInput['variants'].push({});
            this.subVariants.push({});
        },
        deleteVariant(index) {
            if (_.has(this.formInput, `variants.${index}`)) {
                if (_.get(this.formInput, `variants.${index}.id`, null)) {
                    if (!this.formInput['delete_variants'] || _.isEmpty(this.formInput['delete_variants'])) {
                        this.formInput['delete_variants'] = [];
                    }
                    this.formInput['delete_variants'].push({id: _.get(this.formInput, `variants.${index}.id`, null)});
                }
                this.formInput['variants'].splice(index, 1);
                this.subVariants.splice(index, 1);
                this.updateStock();
            }
        },
        updateStock() {
            const total = this.formInput['stocks'].reduce((sum, item) => {
                sum = +sum;
                sum += +item.stock
                return sum;
            }, 0);
            this.formInput['stock'] = +total;
        },
        addNewStock(btn) {
            if (!this.formInput['stocks'] || _.isEmpty(this.formInput['stocks'])) {
                this.formInput['stocks'] = [];
            }
            this.formInput['stocks'].push({});
        },
        deleteStock(index) {
            if (_.has(this.formInput, `stocks.${index}`)) {
                if (_.get(this.formInput, `stocks.${index}.id`, null)) {
                    if (!this.formInput['delete_stocks'] || _.isEmpty(this.formInput['delete_stocks'])) {
                        this.formInput['delete_stocks'] = [];
                    }
                    this.formInput['delete_stocks'].push({id: _.get(this.formInput, `stocks.${index}.id`, null)});
                }
                this.formInput['stocks'].splice(index, 1);
                this.updateStock();
            }
        },
    },
}
</script>

<style scoped>

</style>
