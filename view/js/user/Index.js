function createUser() {
  // Prevent default form submission behavior
  console.log("creating user");
  //   // Check if the form is valid
  //     let form = this;
  //     if (!form.checkValidity()) {
  //       // If the form is not valid, show the default validation message
  //       form.reportValidity();
  //       return;
  //     }

  //     // Serialize form data
  //     let formData = new FormData(form);

  // Show loading message (optional)
  Swal.fire({
    title: "Updating...",
    text: "Please wait while we update your details.",
    allowOutsideClick: false,
    onBeforeOpen: () => {
      Swal.showLoading();
    },
  });

  // Send form data using AJAX
  //   $.ajax({
  //     url: "../../../controller/admin/admin_action.php",
  //     type: "POST",
  //     data: formData,
  //     processData: false,
  //     contentType: false,
  //     success: function (response) {
  //       console.log(response);
  //       let data = JSON.parse(response);

  //       // Check if the response is successful before showing confirmation dialog
  //       if (data.status === "success") {
  // Show confirmation dialog

  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to undo this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, update it!",
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        `../../controller/admin/admin_action.php`, {
          id: $("#userId").val(),
          username: $("#username").val(),
          gmail: $("#gmail").val(),
          old_password: $("#old-password").val(),
          new_password: $("#new-password").val(),
          confirm_password: $("#confirm-password").val(),
        },
        function(response) {
          console.log(response);
          let data = JSON.parse(response);

          // Check if the response is successful before showing confirmation dialog
          if (data.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Admin details have been changed",
              showConfirmButton: false,
              timer: 1500,
            }).then(() => {
              // Redirect to the dashboard after clicking OK
              window.location.href = "index.php?page=users";
            });
          } else {
            // Show error message
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
            });
          }
        },
      );
      // Show success message
    }
  });

  // Prevent the form from being submitted normally
  return false;
}

function togglePasswordVisibility(inputId, iconId) {
  const passwordField = document.getElementById(inputId);
  const togglePasswordIcon = document.getElementById(iconId);

  if (passwordField.type === "password") {
    passwordField.type = "text";
    togglePasswordIcon.classList.remove("bx-show");
    togglePasswordIcon.classList.add("bx-hide");
  } else {
    passwordField.type = "password";
    togglePasswordIcon.classList.remove("bx-hide");
    togglePasswordIcon.classList.add("bx-show");
  }
}
