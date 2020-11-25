<template>
    <form name={formName}>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="bed_no">Bed Number : <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="bed_no"
                        class="form-control form-control-sm is-invalid"
                        name="bed_no"
                        value="info.bed_no"
                        placeholder="Enter bed number.."/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="bed_no2">Bed Number : <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="bed_no2"
                        class="form-control form-control-sm is-invalid"
                        name="bed_no"
                        value="info.bed_no"
                        placeholder="Enter bed number.."/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="bed_type">Bed Type :</label>
                    <select
                        class="form-control form-control-sm"
                        name="bed_type"
                        value="info.bed_type"
                        id="bed_type">
                        <option value="Normal">Normal</option>
                        <option value="AC">AC</option>
                        <option value="VIP">VIP</option>
                        <option value="Cabin">Cabin</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "form.component"
}
</script>

<style scoped>

</style>
