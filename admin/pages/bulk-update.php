<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title">Upload CSV File</h5>
                <a href="/admin/templates/tracking_data.csv" target="_blank">Download Template</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <form id="frmBulkUpload">
                            <div class="row mb-3">
                                <label for="formFile" class="col-form-label">Select a CSV file</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="file" id="formFile" name="csv_file" />
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>



            </div>
        </div>
    </div>
</div>