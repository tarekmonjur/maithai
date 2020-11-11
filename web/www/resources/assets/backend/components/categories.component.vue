<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Other browsers</td>
                            <td>All others</td>
                            <td>-</td>
                            <td>-</td>
                            <td>U</td>
                            <td>U</td>
                            <td>U</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th width="80px">Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MainContentComponent",
        data() {

        }
    }
</script>

<style scoped>

</style>
