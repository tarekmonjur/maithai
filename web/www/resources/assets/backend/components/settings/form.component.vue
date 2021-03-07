<template>
    <form name="">
        <div class="form-row">
            <div v-for="(form, index) in forms" class="col-md-4" :class="{'col-md-12' : form.type === 'textarea'}">
                <div class="form-group">
                    <label :for="form.id">
                        {{lang(form.name)}} : <span v-if="form.require == 1" class="text-danger">*</span>
                    </label>
                    <input v-if="form.type === 'text' || form.type === 'email' || form.type === 'password'"
                        :type="form.type"
                        :id="form.id"
                        v-model="forms[index]['value']"
                        :class="{'is-invalid' : errors[form.name]}"
                        class="form-control form-control-sm" />
                    <select v-else-if="form.type === 'select'"
                        v-model.lazy="forms[index]['value']"
                        class="form-control form-control-sm">
                        <option selected value="">...Select All...</option>
                        <option v-for="(value, key) in JSON.parse(form.options)" :value="key">{{this.lang(value)}}</option>
                    </select>
                    <input v-else-if="form.type === 'file'"
                           :type="form.type"
                           :id="form.id"
                           :name="forms[index]['name']"
                           @change="filesBrowse($event, index)"
                           :class="{'is-invalid' : errors[form.name]}"
                           class="form-control form-control-sm" />
                    <textarea v-else-if="form.type === 'textarea'"
                        :id="form.id"
                        v-html="forms[index]['value']"
                        :class="{'is-invalid' : errors[form.name]}"
                        class="form-control form-control-sm textarea"></textarea>
                    <div class="invalid-feedback" v-if="errors[form.name]">
                        {{errors[form.name]}}
                    </div>
                </div>
                <img v-if="form.type === 'file' && forms[index]['img']" :src="forms[index]['img']" width="60">
                <img v-else-if="form.type === 'file'" :src="getImage(forms[index]['value'])" width="60">
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <button type="button"
                        :disabled="loader"
                        class="btn btn-theme float-right"
                        @click.prevent.enter="buttonAction()">
                    <loading-component :loader="loader">
                        {{this.lang('save')}}
                    </loading-component>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import {mapState} from "vuex";
import LoadingComponent from './../common/loading.component';
// import './../../../../../public/backend/plugins/summernote/summernote-bs4.css';
// import './../../../../../public/backend/plugins/summernote/summernote-bs4.min';

export default {
    name: "form.component",
    props: ['forms', 'tab'],
    components: {LoadingComponent},
    data() {
      return {
          loader: false,
          errors: {},
      }
    },
    computed: {
        ...mapState([
            'url',
            'lang_key',
        ]),
    },
    updated(){
        console.log('form', this.forms);
    },
    mounted() {
        (function(){
            $(document).ready(function() {
                $('.textarea').summernote({
                    height: 200
                });
            });
        })();
    },
    methods: {
        lang(key) {
            return this.getLang(`${this.lang_key}.${key}`);
        },
        getImage(path){
            path = `${path}?${new Date().getTime()}`;
            return this.assetUrl(path);
        },
        filesBrowse(event, index) {
            const files_name = event.target.name;
            const files = event.target.files;
            this.forms[index][files_name] = files[0];
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onload = (evt) => {
                this.forms[index]['img'] = evt.target.result;
            }
        },
        async buttonAction() {
            for(const form of this.forms) {
                if (form.type === 'textarea') {
                    form.value = $('#'+form.id).summernote('code');
                }
            }

            this.loader = true;
            const payload = {
                url: this.url+'/'+this.tab,
                method: 'POST',
                data: {
                    ...this.forms,
                    _method: 'PUT',
                },
            }
            if (this.tab === 'logo') {
                _.set(payload, 'headers', {'Content-Type': 'multipart/form-data'});
                _.set(payload, 'file_keys', ['qrcode', 'rating_image', 'payment_image']);
            }
            const result = await this.postDataAction(payload);
            if (result && result.code === 200) {
                this.errors = {};
            } else {
                this.errors = _.get(result, 'results', {});
            }
            this.$store.commit('setErrorsAlert',  {
                alert: _.pick(result, ['code', 'message', 'status']),
                errors: {}
            });
            this.loader = false;
        }
    }
}
</script>

<style scoped>

</style>