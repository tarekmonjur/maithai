<template>
    <app-component>
        <section id="login-register" class="mt-5 mb-5">
            <div class="container">
                <div class="formContainer text-center">
                    <h2 class="text-center"
                        :class="data.payment_status === 'success' ? 'text-success' : data.payment_status === 'cancel' ? 'text-danger' : 'text-warning'">
                        {{data.payment_message}}
                    </h2>
                    <br>
                    <h4>Contact with us if you have any query.</h4>
                    <br>
                    <h3><i class="fas fa-phone-alt icon"></i>&nbsp;{{settings.phone ? settings.phone : settings.mobile}}</h3>
                </div>
            </div>
        </section>
    </app-component>
</template>

<script>
import AppComponent from './app.component';
import {mapState} from "vuex";

export default {
    name: "login.component",
    components: {
        AppComponent,
    },
    data() {
        return {
            data: {
                ...window.data
            }
        }
    },
    computed: {
        ...mapState([
            'settings'
        ])
    },
    methods: {
    }
}
</script>

<style scoped>

</style>