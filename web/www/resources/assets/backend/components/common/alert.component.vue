<template>
    <div v-if="alert">{{this.showAlert()}}</div>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "alert.component",
    computed: {
        ...mapState([
            'alert',
        ]),
    },
    methods: {
        showAlert() {
            if (Object.keys(this.alert).length <= 0) {
                return null;
            }

            this.$swal({
                position: 'top-end',
                icon: this.alert.status,
                title: _.capitalize(this.alert.status)+'...!',
                text: this.alert.message,
                showConfirmButton: false,
                timer: 2000,
            });
        }
    }

}
</script>

<style scoped>

</style>
