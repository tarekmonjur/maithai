<template>
    <form name="" id="form">
        <div class="form-group">
            <label for="full_name">{{lang('full_name')}} :<span class="text-danger">*</span></label>
            <input
                type="text"
                id="full_name"
                v-model="formInput['full_name']"
                :class="{'is-invalid' : errors.full_name}"
                class="form-control form-control-sm" />
            <div class="invalid-feedback" v-if="errors.full_name">{{errors.full_name}}</div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="email">{{lang('email')}} :<span class="text-danger">*</span></label>
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
                    <label for="mobile_no">{{lang('mobile_no')}} :<span class="text-danger">*</span></label>
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
        <div class="row">
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
        <div class="row">
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
    name: "shipping-form.component",
    computed: {
        ...mapState([
            'formInput',
            'errors'
        ]),
    },
    methods: {
        lang(key) {
            return this.getLang(`customer.${key}`);
        },
    },
}
</script>

<style scoped>

</style>
