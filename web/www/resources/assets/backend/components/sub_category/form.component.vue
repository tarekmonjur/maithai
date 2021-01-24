<template>
    <form name="">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="category_id">{{lang('category_id')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['category_id']"
                        :class="{'is-invalid' : errors.category_id}"
                        id="category_id">
                        <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.category_id">{{errors.category_id}}</div>
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
import {mapState} from "vuex";

export default {
    name: "form.component",
    computed: {
        ...mapState([
            'lang_key',
            'formInput',
            'errors',
        ]),
        categories: function() {
            return _.get(this.$store.state.formData, 'categories.results');
        },
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
        }
    },
}
</script>

<style scoped>

</style>
