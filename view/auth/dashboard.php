<div class="container-fluid p-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm border-0 bg-light" style="max-width: 18rem;">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Total Applicants</h6>
                        <h3 class="mb-0" id="totalApplicants"></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm border-0 bg-light" style="max-width: 18rem;">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        <i class='bx bxs-user-check'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Accepted Applicants</h6>
                        <h3 class="mb-0" id="acceptedCount"></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm border-0 bg-light" style="max-width: 18rem;">
                <div class="d-flex align-items-center">
                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        <i class='bx bxs-user-x'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Rejected Applicants</h6>
                        <h3 class="mb-0" id="rejectedCount"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
</div>