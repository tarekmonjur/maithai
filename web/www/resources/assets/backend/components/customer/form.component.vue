<template>
    <form name="">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="first_name">{{lang('first_name')}} :<span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="first_name"
                        v-model="formInput['first_name']"
                        :class="{'is-invalid' : errors.first_name}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.first_name">{{errors.first_name}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="last_name">{{lang('last_name')}} :</label>
                    <input
                        type="text"
                        id="last_name"
                        v-model="formInput['last_name']"
                        :class="{'is-invalid' : errors.last_name}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.last_name">{{errors.last_name}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="email">{{lang('email')}} :</label>
                    <input
                        type="text"
                        id="email"
                        v-model="formInput['email']"
                        :class="{'is-invalid' : errors.email}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.email">{{errors.email}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="mobile_no">{{lang('mobile_no')}} :</label>
                    <input
                        type="text"
                        id="mobile_no"
                        v-model="formInput['mobile_no']"
                        :class="{'is-invalid' : errors.mobile_no}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.mobile_no">{{errors.mobile_no}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="username">{{lang('username')}} :</label>
                    <input
                        type="text"
                        id="username"
                        v-model="formInput['username']"
                        :class="{'is-invalid' : errors.username}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.username">{{errors.username}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="password">{{lang('password')}} :</label>
                    <input
                        type="text"
                        id="password"
                        v-model="formInput['password']"
                        :class="{'is-invalid' : errors.password}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.password">{{errors.password}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="retype_password">{{lang('retype_password')}} :</label>
                    <input
                        type="text"
                        id="retype_password"
                        v-model="formInput['retype_password']"
                        :class="{'is-invalid' : errors.retype_password}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.retype_password">{{errors.retype_password}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label>{{lang('gender')}} :</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" v-model="formInput['gender']" id="male" value="male">
                        <label class="form-check-label" for="male">{{lang('male')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" v-model="formInput['gender']" id="female" value="female">
                        <label class="form-check-label" for="female">{{lang('female')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" v-model="formInput['gender']" id="other" value="other">
                        <label class="form-check-label" for="other">{{lang('other')}}</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="image">{{lang('photo')}} :</label>
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
            <div class="col" v-if="formInput['photo']">
                <div class="form-group">
                    <br>
                    <img :src="formInput['photo']" alt="" width="60">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="is_membership">{{lang('is_membership')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['is_membership']"
                        id="is_membership">
                        <option value="1">{{lang('yes')}}</option>
                        <option value="0">{{lang('no')}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.is_membership">{{errors.is_membership}}</div>
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
                    <label for="email_verified">{{lang('email_verified')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['email_verified']"
                        id="email_verified">
                        <option value="1">{{lang('verified')}}</option>
                        <option value="0">{{lang('unverified')}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.email_verified">{{errors.email_verified}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="city">{{lang('city')}} :</label>
                    <input
                        type="text"
                        id="city"
                        v-model="formInput['city']"
                        :class="{'is-invalid' : errors.city}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.city">{{errors.city}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="state">{{lang('state')}} :</label>
                    <input
                        type="text"
                        id="state"
                        v-model="formInput['state']"
                        :class="{'is-invalid' : errors.state}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.state">{{errors.state}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="zip_code">{{lang('zip_code')}} :</label>
                    <input
                        type="text"
                        id="zip_code"
                        v-model="formInput['zip_code']"
                        :class="{'is-invalid' : errors.zip_code}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.zip_code">{{errors.zip_code}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="address">{{lang('address')}} :</label>
                    <textarea
                        id="address"
                        v-model="formInput['address']"
                        :class="{'is-invalid' : errors.address}"
                        class="form-control form-control-sm"></textarea>
                    <div class="invalid-feedback" v-if="errors.address">{{errors.address}}</div>
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
