
$(document).ready(function() {
    $('#addAdminForm').on('submit', function(e) {
        e.preventDefault();

        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();

        // Check if passwords match
        if (password !== confirmPassword) {
            Swal.fire("Error", "Passwords do not match.", "error");
            return;
        }

        $.ajax({
            url: "../../controller/admin/add_user.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                var data = JSON.parse(response);

                if (data.success) {
                    Swal.fire("Success", "Admin user added successfully.", "success").then(() => {
                        // Reload the page to see the new user in the list
                        location.reload();
                    });
                } else {
                    Swal.fire("Error", data.message, "error");
                }
            },
            error: function() {
                Swal.fire("Error", "An error occurred while saving the admin.", "error");
            }
        });
    });
});
