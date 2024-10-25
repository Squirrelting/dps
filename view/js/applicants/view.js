function getApplicantDetails() {
  const urlParams = new URLSearchParams(window.location.search);
  const applicantId = urlParams.get("applicantId");
  $.ajax({
    url: `../../controller/applicants/getApplicantDetails.php?id=${applicantId}`,
    type: "GET",
    success: function (response) {
      let data = JSON.parse(response);
      $("#applicantName").text(
        data.applicant.lastname +
          ", " +
          data.applicant.firstname +
          " " +
          data.applicant.middlename
      );
      $("#applicantEmail").text(data.applicant.email);
      $("#applicantAge").text(data.applicant.age);
      $("#applicantSex").text(data.applicant.sex);
      $("#applicantBirthdate").text(data.applicant.birthdate);
      $("#applicantHeight").text(data.applicant.height);
      $("#applicantWeight").text(data.applicant.weight);
      $("#applicantCivilStatus").text(data.applicant.civil_status);
      $("#applicantCitizenship").text(data.applicant.citizenship);
      $("#applicantAddress").text(
        data.applicant.barangay +
          ", " +
          data.applicant.municipality +
          ", " +
          data.applicant.province +
          ", " +
          data.applicant.country
      );
      $("#parentMothername").text(
        data.parent.mother_lastname +
          ", " +
          data.parent.mother_firstname +
          " " +
          data.parent.mother_middlename
      );
      $("#parentFathername").text(
        data.parent.father_lastname +
          ", " +
          data.parent.father_firstname +
          " " +
          data.parent.father_middlename
      );
      $("#parentMotherOccupation").text(data.parent.mother_occupation);
      $("#parentFatherOccupation").text(data.parent.father_occupation);

      let placeholder = document.querySelector("#options");
      if (data.applicant.status === "PENDING") {
        let out = `
            <button type="button" class="btn btn-success" onclick="acceptApplicant(${applicantId})">Accept</button>
            <button type="button" class="btn btn-danger" onclick="rejectApplicant(${applicantId})">Reject</button>`;
        placeholder.innerHTML = out;
      }

      placeholder.innerHTML = out;
    },
    error: function (error) {
      console.error("Error fetching data:", error);
    },
  });
}

function acceptApplicant(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "You are about to accept this applicant. Continue?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, accept it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `../../controller/applicants/accept_applicant.php?id=${id}`,
        type: "GET",
        success: function (response) {
          let data = JSON.parse(response);
          if (data.status === "error") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: data.message,
            });
          } else if (data.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Success",
              text: "Accepted successfully!",
              showConfirmButton: false,
              timer: 1500,
            }).then(function () {
              getApplicantDetails();
              getApplicants();
              getApplicantsPendingCount();
            });
          }
        },
      });
    }
  });
}

function rejectApplicant(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "You are about to reject this applicant. Continue?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, reject it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `../../controller/applicants/reject_applicant.php?id=${id}`,
        type: "GET",
        success: function (response) {
          let data = JSON.parse(response);
          if (data.status === "error") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: data.message,
            });
          } else if (data.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Success",
              text: "Rejected successfully!",
              showConfirmButton: false,
              timer: 1500,
            }).then(function () {
              getApplicantDetails();
              getApplicants();
              getApplicantsPendingCount();
            });
          }
        },
      });
    }
  });
}
