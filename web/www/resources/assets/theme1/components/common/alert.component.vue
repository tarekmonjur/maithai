<template>
    <div v-if="alert || data">{{this.showAlert()}}</div>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "alert.component",
    props: ['data'],
    computed: {
        ...mapState([
            'alert',
        ]),
    },
    methods: {
        showAlert() {
            console.log('show alert');
            const alert = !_.isEmpty(this.alert) ? this.alert : this.data;
            if (Object.keys(alert).length <= 0) {
                return null;
            }

            this.$swal({
                position: 'top-end',
                icon: alert.status,
                title: _.capitalize(alert.status)+'...!',
                text: alert.message,
                showConfirmButton: false,
                timer: 3000,
            });
        }
    }

}
</script>

<style scoped>

</style>
