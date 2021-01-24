<template>
    <div class="card card-gray card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                {{this.lang('application_settings')}}
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a v-for="(settings, key) in settingsData"
                           class="nav-link"
                           :class="{'active' : current_tab ===  key}"
                           @click.prevent="current_tab = key"
                           :id="`vert-tabs-${key}-tab`"
                           data-toggle="pill"
                           :href="`#vert-tabs-${key}`"
                           :role="key"
                           :aria-controls="`vert-tabs-${key}`"
                           aria-selected="true">
                            {{this.lang(key+'_settings')}}
                        </a>
                    </div>
                </div>
                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div v-for="(settings, key) in settingsData"
                             class="tab-pane text-left fade show"
                             :class="{'active' : current_tab ===  key}"
                             :id="`vert-tabs-${key}`"
                             role="tabpanel"
                             :aria-labelledby="`vert-tabs-${key}-tab`">
                            <form-component :forms="settings" :tab="key"></form-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <alert-component></alert-component>
</template>

<script>
import {mapState, mapGetters} from "vuex";
import FormComponent from './form.component';
import AlertComponent from './../common/alert.component';

export default {
    name: "settings.component",
    components: {
        FormComponent,
        AlertComponent
    },
    data() {
      return {
          current_tab: 'app',
      }
    },
    computed: {
        ...mapState([
            'lang_key',
        ]),
        ...mapGetters([
            'settingsData'
        ]),
    },
    created() {
        this.$store.dispatch('init');
    },
    updated() {
        // console.log('settings', this.settingsData);
    },
    methods: {
        lang(key) {
            return this.getLang(`${this.lang_key}.${key}`);
        },
    }
}
</script>

<style scoped>

</style>