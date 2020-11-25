<template>
    <div class="collapse row justify-content-center" id="tableFilter">
        <div class="card col-10">
            <form action="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend btn-outline-secondary">
                                <div class="input-group-text p-0">
                                    <select class="form-control form-control-sm">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend btn-outline-secondary">
                                <div class="input-group-text p-0">
                                    <select class="form-control form-control-sm">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    From Date
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    To Date
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-theme btn-sm">
                            <img :src="this.asset('/img/search.png')" alt="">
                            {{filterButtonName}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "table-filter.component",
    computed: {
        ...mapGetters([
            'filterButtonName'
        ])
    }
}
</script>

<style scoped>

</style>
