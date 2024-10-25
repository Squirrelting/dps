function getApplicants() {
  fetch("../../controller/applicants/getApplicants.php")
    .then(function (response) {
      return response.json();
    })
    .then(function (applicants) {
      let placeholder = document.querySelector("#applicants-data");
      let out = "";
      var no = 1;

      for (let applicant of applicants) {
        let status = '';
        if(applicant.status == "PENDING") {
            status = `<p class="text-warning fw-bold">${applicant.status}</p>`;
        } else if(applicant.status == "ACCEPTED") {
            status = `<p class="text-success fw-bold">${applicant.status}</p>`;
        } else if(applicant.status == "REJECTED") {
            status = `<p class="text-danger fw-bold">${applicant.status}</p>`;
        }
        out += `<tr>
                          <td>${no++}</td>`;

        out += `<td>${applicant.lastname}, ${applicant.firstname} ${applicant.middlename}</td>
                              <td>${applicant.email}</td>
                              <td>${applicant.age}</td>
                              <td>${applicant.sex}</td>
                              <td>${status}</td>
                              <td><a href="?page=viewApplicant&applicantId=${applicant.id}" data-switcher data-tab="viewApplicant" class="btn btn-primary">View</a>
<button onclick="deleteApplicant(${applicant.id})" type="button" class="btn btn-danger">Delete</button></td>`;

        out += `</tr>`;
      }

      $("#applicantsTable").DataTable().destroy();
      placeholder.innerHTML = out;
      $("#applicantsTable").DataTable();
    })
    .catch(function (error) {
      console.error("Error fetching data:", error);
    });
}

function deleteApplicant(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `../../controller/applicants/delete_applicant.php?id=${id}`,
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
              text: "Deleted successfully!",
              showConfirmButton: false,
              timer: 1500,
            }).then(function () {
              getApplicants();
              getApplicantsPendingCount();
            });
          }
        },
      });
    }
  });
}

function getApplicantsPendingCount() {
    $.ajax({
        url: "../../controller/applicants/applicant_count_pending.php",
        type: "GET",
        success: function (response) {
            let data = JSON.parse(response);
            $("#pendingCount").text(data.count);
        },
    });
}
