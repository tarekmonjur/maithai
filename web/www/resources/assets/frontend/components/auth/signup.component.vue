<template>
    <app-component>
        <section id="login-register" class="mt-5 mb-5">
            <div class="container">
                <div class="formContainer">
                    <div class="row form-row d-flex">
                        <div class="register-section-2">
                            <form class="form-section" style="margin-right: 2rem;">
                                <div class="form-label">
                                    <h1 class="text-capitalize mb-4">register now !</h1>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text"
                                               class="form-control"
                                               :class="{'is-invalid' : errors.first_name}"
                                               v-model="formInput.first_name"
                                               placeholder="First Name...">
                                        <div class="invalid-feedback" v-if="errors.first_name">{{errors.first_name}}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text"
                                               class="form-control"
                                               :class="{'is-invalid' : errors.last_name}"
                                               v-model="formInput.last_name"
                                               placeholder="Last Name...">
                                        <div class="invalid-feedback" v-if="errors.last_name">{{errors.last_name}}</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                           class="form-control"
                                           :class="{'is-invalid' : errors.email}"
                                           v-model="formInput.email"
                                           placeholder="Email Address...">
                                    <div class="invalid-feedback" v-if="errors.email">{{errors.email}}</div>
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control"
                                           :class="{'is-invalid' : errors.mobile_no}"
                                           v-model="formInput.mobile_no"
                                           placeholder="Phone/Mobile Number...">
                                    <div class="invalid-feedback" v-if="errors.mobile_no">{{errors.mobile_no}}</div>
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control"
                                           :class="{'is-invalid' : errors.username}"
                                           v-model="formInput.username"
                                           placeholder="User Name...">
                                    <div class="invalid-feedback" v-if="errors.username">{{errors.username}}</div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input type="password"
                                               class="form-control"
                                               :class="{'is-invalid' : errors.password}"
                                               v-model="formInput.password"
                                               placeholder="Password...">
                                        <div class="invalid-feedback" v-if="errors.password">{{errors.password}}</div>
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="password"
                                               class="form-control"
                                               :class="{'is-invalid' : errors.retype_password}"
                                               v-model="formInput.retype_password"
                                               placeholder="Re-password...">
                                        <div class="invalid-feedback" v-if="errors.retype_password">{{errors.retype_password}}</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control"
                                              :class="{'is-invalid' : errors.address}"
                                              v-model="formInput.address"
                                              placeholder="Address..."></textarea>
                                    <div class="invalid-feedback" v-if="errors.address">{{errors.address}}</div>
                                </div>
                                <div class="form-group">
                                    <a href="javascript:void(0)"
                                       :class="loader? 'disabled': ''"
                                       @click.prevent="signup()"
                                       class="btn btn-custom register-btn text-capitalize">
                                        <loader-component :loader="loader">
                                            Register
                                        </loader-component>
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="login-section-2 ml-2 mr-4">
                            <div class="form-section" style="margin-left: 2rem;">
                                <div class="form-label">
                                    <h1 class="text-capitalize">already have an account ?</h1>
                                </div>
                                <div class="form-label mt-4 mb-4">
                                    <p>
                                        Go to login section to login now. If you are have already an account. You can know our users login &
                                        register policy. And follow our terms (Changing Or Accessing Your Information) of user registration &
                                        login from <mark><a :href="this.url('/terms-policy')">here</a></mark>
                                    </p>
                                </div>
                                <a :href="this.url('/login')" class="btn login-btn">Go For Login</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import LoaderComponent from './../common/loading.component';
import {mapState} from "vuex";

export default {
    name: "signup.component",
    components: {
        AppComponent,
        LoaderComponent
    },
    data() {
        return {
            loader: false,
            formInput: {},
        }
    },
    computed: {
        ...mapState([
            'settings',
            'errors',
        ])
    },
    methods: {
        async signup() {
            this.loader = true;
            await this.$store.dispatch('signupAction', {
                data: {
                    ...this.formInput
                }
            });
            this.loader = false;
            if (_.isEmpty(this.errors)) {
                this.formInput = {};
                window.location.href = this.url('/login');
            }
        }
    }
}
</script>

<style scoped>

</style>