<template>
    <section id="contact-us">
        <div id="add-restaurant" class="add-restaurant mb-5 mt-5 container">
            <form action="">
                <div class="row mb-5">
                    <div class="col-md-12 text-center mt-5 d-block">
                        <h2 class="text-capitalize contact-title">To Get contact with MaiThai Kitchen add your message.</h2>
                        <p class="text-capitalize">come & contact with us</p>
                        <div class="underline mt-3 m-auto"
                             style="border-bottom: 4px solid tomato; width: 5rem; padding-top: 15px;"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <input
                            type="text"
                            class="form-control"
                            :class="{'is-invalid' : errors.first_name}"
                            v-model="formInput.first_name"
                            placeholder="First Name...">
                        <div class="invalid-feedback" v-if="errors.first_name">{{errors.first_name}}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <input
                            type="text"
                            placeholder="Last Name..."
                            :class="{'is-invalid' : errors.last_name}"
                            v-model="formInput.last_name"
                            class="form-control">
                        <div class="invalid-feedback" v-if="errors.last_name">{{errors.last_name}}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <input
                            type="email"
                            placeholder="Email Address..."
                            :class="{'is-invalid' : errors.email}"
                            v-model="formInput.email"
                            class="form-control">
                        <div class="invalid-feedback" v-if="errors.email">{{errors.email}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <textarea
                            cols="" rows="10"
                            placeholder="Your Message..."
                            :class="{'is-invalid' : errors.message}"
                            v-model="formInput.message"
                            class="form-control">
                        </textarea>
                        <div class="invalid-feedback" v-if="errors.message">{{errors.message}}</div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div>
                        <button
                            type="submit"
                            @click.prevent="sendContactMessage()"
                            :disabled="loader"
                            class="btn btn-lg text-light text-uppercase">
                            <loader-component :loader="loader">
                                submit your message
                            </loader-component>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
import LoaderComponent from './../common/loading.component';
import {mapState} from "vuex";

export default {
    name: "contact-form.component",
    components: {
        LoaderComponent
    },
    data() {
        return {
            errors: {},
            formInput: {},
            loader: false,
        }
    },
    computed: {
        ...mapState(['settings'])
    },
    methods: {
        async sendContactMessage() {
            this.loader = true;
            const payload = {
                url: '/send-contact-message',
                method: 'POST',
                data: this.formInput,
            }
            const result = await this.postDataAction(payload);
            if (_.get(result, 'code') === 200 && _.get(result, 'status') === 'success') {
                this.errors = {};
                this.formInput = {};
            } else {
                this.errors = _.get(result, 'results', {}) || {};
            }
            this.loader = false;
            this.$swal({
                position: 'top-end',
                icon: _.get(result, 'status', ''),
                title: _.capitalize(_.get(result, 'status', ''))+'...!',
                text: _.get(result, 'message', ''),
                showConfirmButton: false,
                timer: 2000,
            });
        }
    }
}
</script>

<style scoped>

</style>