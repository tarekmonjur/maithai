<template>
    <app-component>
        <section id="login-register" class="mt-5 mb-5">
            <div class="container">
                <div class="formContainer">
                    <div class="row form-row d-flex">
                        <div class="register-section-2">
                            <form action="" class="form-section" style="margin-right: 2rem;">
                                <div class="form-label">
                                    <h1 class="text-capitalize mb-4">register now !</h1>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="First Name...">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="Last Name...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email Address...">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Phone/Mobile Number...">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="User Name...">
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input type="password" class="form-control" placeholder="Password...">
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="password" class="form-control" placeholder="Re-password...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Address..."></textarea>
                                </div>
                                <div class="form-group">
                                    <a href="register.html" class="btn btn-lg btn-warning register-btn text-capitalize">
                                        Register
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
import {mapState} from "vuex";

export default {
    name: "signup.component",
    components: {
        AppComponent,
    },
    computed: {
        ...mapState(['settings'])
    },
}
</script>

<style scoped>

</style>