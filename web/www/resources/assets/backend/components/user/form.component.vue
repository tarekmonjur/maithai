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
                    <label for="designation">{{lang('designation')}} :</label>
                    <input
                        type="text"
                        id="designation"
                        v-model="formInput['designation']"
                        :class="{'is-invalid' : errors.designation}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.designation">{{errors.designation}}</div>
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
                    <label for="photo">{{lang('photo')}} :</label>
                    <input
                        type="file"
                        id="photo"
                        name="photo"
                        @change="filesBrowse($event)"
                        :class="{'is-invalid' : errors.photo}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.photo">{{errors.photo}}</div>
                </div>
            </div>
            <div class="col" v-if="formInput['photo']">
                <div class="form-group">
                    <br>
                    <img :src="this.photo ? this.photo : formInput['photo']" alt="" width="60">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="user_type">{{lang('user_type')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['user_type_id']"
                        id="user_type">
                        <option v-for="type in types" :value="type.id">{{type.name}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.user_type_id">{{errors.user_type_id}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="user_service_type">{{lang('user_service_type')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['user_service_type_id']"
                        id="user_service_type">
                        <option v-for="service in services" :value="service.id">{{service.name}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.user_service_type_id">{{errors.user_service_type_id}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="user_status">{{lang('user_status')}} :</label>
                    <select
                        class="form-control form-control-sm"
                        v-model="formInput['user_status_id']"
                        id="user_status">
                        <option v-for="sts in status" :value="sts.id">{{sts.name}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.user_status_id">{{errors.user_status_id}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="date_of_birth">{{lang('date_of_birth')}} :</label>
                    <datepicker
                        id="date_of_birth"
                        wrapper-class="form-control datepicker"
                        input-class="form-control form-control-sm input"
                        :placeholder="lang('date_of_birth')"
                        :value="formInput['date_of_birth']"
                        @selected="setDate($event, 'date_of_birth')"
                        iconColor="#be9653"
                        :typeable="true"
                        name="date_of_birth">
                    </datepicker>
                    <div class="invalid-feedback" v-if="errors.date_of_birth">{{errors.date_of_birth}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="joining_date">{{lang('joining_date')}} :</label>
                    <datepicker
                        id="joining_date"
                        wrapper-class="form-control datepicker"
                        input-class="form-control form-control-sm input"
                        :placeholder="lang('joining_date')"
                        :value="formInput['joining_date']"
                        @selected="setDate($event, 'joining_date')"
                        iconColor="#be9653"
                        :typeable="true"
                        name="joining_date">
                    </datepicker>
                    <div class="invalid-feedback" v-if="errors.joining_date">{{errors.joining_date}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="salary">{{lang('salary')}} :</label>
                    <input
                        type="number"
                        id="salary"
                        v-model="formInput['salary']"
                        :class="{'is-invalid' : errors.salary}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.salary">{{errors.salary}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="father_name">{{lang('father_name')}} :</label>
                    <input
                        type="text"
                        id="father_name"
                        v-model="formInput['father_name']"
                        :class="{'is-invalid' : errors.father_name}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.father_name">{{errors.father_name}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="mother_name">{{lang('mother_name')}} :</label>
                    <input
                        type="text"
                        id="mother_name"
                        v-model="formInput['mother_name']"
                        :class="{'is-invalid' : errors.mother_name}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.mother_name">{{errors.mother_name}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="present_address">{{lang('present_address')}} :</label>
                    <textarea
                        id="present_address"
                        v-model="formInput['present_address']"
                        :class="{'is-invalid' : errors.present_address}"
                        class="form-control form-control-sm"></textarea>
                    <div class="invalid-feedback" v-if="errors.present_address">{{errors.present_address}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="permanent_address">{{lang('permanent_address')}} :</label>
                    <textarea
                        id="permanent_address"
                        v-model="formInput['permanent_address']"
                        :class="{'is-invalid' : errors.permanent_address}"
                        class="form-control form-control-sm"></textarea>
                    <div class="invalid-feedback" v-if="errors.permanent_address">{{errors.permanent_address}}</div>
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
                        type="password"
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
                        type="password"
                        id="retype_password"
                        v-model="formInput['retype_password']"
                        :class="{'is-invalid' : errors.retype_password}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.retype_password">{{errors.retype_password}}</div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import {mapState, mapGetters} from "vuex";
import Datepicker from 'vuejs3-datepicker';

export default {
    name: "form.component",
    components: {
        Datepicker
    },
    data() {
      return {photo: null}
    },
    computed: {
        ...mapState([
            'lang_key',
            'formInput',
            'errors',
        ]),
        ...mapGetters([
            'types',
            'services',
            'status',
        ]),
    },
    updated() {
        console.log(this.formInput, this.date_of_birth);
    },
    methods: {
        lang(key) {
            return this.getLang(`${this.lang_key}.${key}`);
        },
        filesBrowse(event) {
            const files_name = event.target.name;
            const files = event.target.files;
            this.formInput[files_name] = files[0];
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onload = (evt) => {
                this.photo = evt.target.result;
            }
        },
        setDate(value, name) {
            if ((new Date(value) !== "Invalid Date" && !isNaN(new Date(value))) || !isNaN(Date.parse(value))) {
                value = new Date(value).toISOString().toString();
            }
            this.formInput[name] = value;
        }
    },
}
</script>

<style scoped>

</style>
