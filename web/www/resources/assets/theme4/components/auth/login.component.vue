<template>
    <app-component>
        <section id="login-register" class="mt-5 mb-5">
            <div class="container">
                <div class="formContainer">
                    <div class="row form-row d-flex">
                        <div class="login-section ml-2 mr-4">
                            <form action="" class="form-section" style="margin-left: 2rem;">
                                <div class="form-label">
                                    <h1 class="text-capitalize">user login</h1>
                                </div>
                                <div class="text-danger" v-if="errors.unauthenticated">{{errors.unauthenticated[0]}}</div>
                                <div class="form-group mt-4">
                                    <input type="email"
                                           class="form-control"
                                           :class="{'is-invalid' : errors.username}"
                                           v-model="formInput.username"
                                           placeholder="Username...">
                                    <div class="invalid-feedback" v-if="errors.username">{{errors.username}}</div>
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                           class="form-control"
                                           :class="{'is-invalid' : errors.password}"
                                           v-model="formInput.password"
                                           placeholder="Password...">
                                    <div class="invalid-feedback" v-if="errors.password">{{errors.password}}</div>
                                </div>
<!--                                <div class="form-group form-check">-->
<!--                                    <input type="checkbox"-->
<!--                                           class="form-check-input"-->
<!--                                           v-model="formInput.remember"-->
<!--                                           value="1"-->
<!--                                           id="remember">-->
<!--                                    <label class="form-check-label" for="remember">Remember me!</label>-->
<!--                                </div>-->
                                <button
                                    type="submit"
                                    :disabled="loader"
                                    @click.prevent="login()"
                                    class="btn login-btn">
                                    <loader-component :loader="loader">
                                        Login
                                    </loader-component>
                                </button>
                            </form>
                        </div>

                        <div class="register-section">
                            <form action="" class="form-section" style="margin-right: 2rem;">
                                <div class="form-label">
                                    <h1 class="text-capitalize mb-4">register for first time user?</h1>
                                    <p class="mb-4">
                                        If you havn't any "{{settings.name}}" account, you can register from here. And login with your account. You can
                                        follow our terms <mark><a :href="this.url('/terms-policy')">here</a></mark>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <a :href="this.url('/signup')" class="btn btn-custom register-btn text-capitalize">
                                        continue to register
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </app-component>
</template>

<script>
import {mapState} from "vuex";
import AppComponent from './../app.component';
import LoaderComponent from "../common/loading.component";

export default {
    name: "login.component",
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
            'errors'
        ])
    },
    methods: {
        async login() {
            this.loader = true;
            await this.$store.dispatch('loginAction', {
                data: {
                    ...this.formInput
                }
            });
            this.loader = false;
            if (_.isEmpty(this.errors)) {
                this.formInput = {};
                window.location.href = this.url('/my-orders');
            }
        }
    }
}
</script>

<style scoped>

</style>