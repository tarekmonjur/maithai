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
    },
    methods: {
        lang(key) {
            return this.getLang(`${this.lang_key}.${key}`);
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
