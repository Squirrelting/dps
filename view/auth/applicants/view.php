<div class="container-fluid p-2">
    <p class="fw-normal">View applicant details</p>
    <div class="d-flex flex-row gap-2">
        <a href="?page=applicants" data-switcher data-tab="applicants" class="btn btn-secondary"><i
                class='bx bx-arrow-back'></i> Back</a>
        <div id="options">
        </div>
    </div>

    <div class="container mt-3">
        <h2 class="text-center mb-4">Review Information</h2>

        <div class="row">
            <!-- Applicant Information Column -->
            <div class="col-md-6">
                <h3 class="section-header">Applicant Information</h3>
                <div class="border p-2 rounded review-info">
                    <p><strong>Name: <p id="applicantName"></p></strong> </p>
                    <p><strong>Email: <p id="applicantEmail"></p></strong> </p>
                    <p><strong>Age: <p id="applicantAge"></p></strong> </p>
                    <p><strong>Sex: <p id="applicantSex"></p></strong> </p>
                    <p><strong>Birthdate: <p id="applicantBirthdate"></p></strong> </p>
                    <p><strong>Height: <p id="applicantHeight"></p></strong> </p>
                    <p><strong>Weight: <p id="applicantWeight"></p></strong> </p>
                    <p><strong>Status: <p id="applicantCivilStatus"></p></strong> </p>
                    <p><strong>Citizenship: <p id="applicantCitizenship"></p></strong> </p>
                    <p><strong>Address: <p id="applicantAddress"></p></strong> </p>
                </div>
            </div>

            <!-- Parents/Guardian Information Column -->
            <div class="col-md-6">
                <h3 class="section-header">Parents/Guardian Information</h3>
                <div class="border p-2 rounded review-info">
                    <p><strong>Mother's Name: <p id="parentMothername"></p></strong>
                    </p>
                    <p><strong>Mother's Occupation: <p id="parentMotherOccupation"></p></strong>
                    </p>
                    <p><strong>Father's Name: <p id="parentFathername"></p></strong>
                    </p>

                    </p>
                    <p><strong>Father's Occupation: <p id="parentFatherOccupation"></p></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Set a interview date</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="acceptApplicant(); return false">
                <div class="d-flex flex-row">
                    <div class="modal-body">
                        <div class="container">
                            <p>Select a Date</p>
                            <div class="form-group date-picker-container">
                                <input type="date" id="interviewDate" class="form-control date-picker" id="dateInput"
                                    placeholder="Select date" required />
                                <span class="calendar-icon">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3">
                        <p>Select a Time</p>
                        <div class="form-group time-picker-container">
                            <input type="time" id="interviewTime" class="form-control time-picker" id="timeInput" required/>
                            <span class="clock-icon">
                                <i class="fas fa-clock" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>