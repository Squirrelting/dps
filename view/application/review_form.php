<?php session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['parents'] = [
        'mother_firstname' => $_POST['mother_firstname'] ??
            '',
        'mother_middlename' => $_POST['mother_middlename'] ?? '',
        'mother_lastname' => $_POST['mother_lastname'] ?? '',
        'mother_occupation' => $_POST['mother_occupation'] ?? '',
        'father_firstname' => $_POST['father_firstname'] ?? '',
        'father_middlename' => $_POST['father_middlename'] ?? '',
        'father_lastname' => $_POST['father_lastname'] ?? '',
        'father_occupation' => $_POST['father_occupation'] ?? ''
    ];
}

// Ensure applicant and parents session variables are set
$applicant = $_SESSION['applicant'] ?? [];
$parents = $_SESSION['parents'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Information</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="icon" href="image/shield.jpg" type="image/vnd.microsoft.icon">

    <style>
        .review-info p {
            margin: 0.2rem 0;
            /* Reduced margin for paragraphs */
        }

        .navbar {
            background-color: #28a745;
            /* Light blue navbar */
        }

        .navbar-brand {
            color: black;
            font-weight: bold;
        }

        .section-header {
            color: #007bff;
            /* Primary color for section headers */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HERO SECURITY AND INVESTIGATION SERVICES</a>
        </div>
    </nav>

    <div class="container mt-3">
        <h2 class="text-center mb-4">Review Information</h2>

        <div class="row">
            <!-- Applicant Information Column -->
            <div class="col-md-6">
                <h3 class="section-header">Applicant Information</h3>
                <div class="border p-2 rounded review-info">
                    <p><strong>First Name:</strong> <?= htmlspecialchars($applicant['lastname'] ?? 'N/A') ?>,
                        <?= htmlspecialchars($applicant['firstname'] ?? 'N/A') ?>
                        <?= htmlspecialchars($applicant['middlename'] ?? 'N/A') ?>
                    </p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($applicant['email'] ?? 'N/A') ?></p>
                    <p><strong>Age:</strong> <?= htmlspecialchars($applicant['age'] ?? 'N/A') ?></p>
                    <p><strong>Sex:</strong> <?= htmlspecialchars($applicant['sex'] ?? 'N/A') ?></p>
                    <p><strong>Birthdate:</strong> <?= htmlspecialchars($applicant['birthdate'] ?? 'N/A') ?></p>
                    <p><strong>Height:</strong> <?= htmlspecialchars($applicant['height'] ?? 'N/A') ?></p>
                    <p><strong>Weight:</strong> <?= htmlspecialchars($applicant['weight'] ?? 'N/A') ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($applicant['status'] ?? 'N/A') ?></p>
                    <p><strong>Citizenship:</strong> <?= htmlspecialchars($applicant['citizenship'] ?? 'N/A') ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($applicant['barangay'] ?? 'N/A') ?>,
                        <?= htmlspecialchars($applicant['municipality'] ?? 'N/A') ?>,
                        <?= htmlspecialchars($applicant['province'] ?? 'N/A') ?>,
                        <?= htmlspecialchars($applicant['country'] ?? 'N/A') ?>
                    </p>
                </div>
            </div>

            <!-- Parents/Guardian Information Column -->
            <div class="col-md-6">
                <h3 class="section-header">Parents/Guardian Information</h3>
                <div class="border p-2 rounded review-info">
                    <p><strong>Mother's Name:</strong>
                        <?= htmlspecialchars($parents['mother_firstname'] ?? 'N/A') ?>,
                        <?= htmlspecialchars($parents['mother_lastname'] ?? 'N/A') ?>
                        <?= htmlspecialchars($parents['mother_middlename'] ?? 'N/A') ?>
                    </p>
                    <p><strong>Mother's Occupation:</strong>
                        <?= htmlspecialchars($parents['mother_occupation'] ?? 'N/A') ?></p>
                    <p><strong>Father's Name:</strong>
                        <?= htmlspecialchars($parents['father_firstname'] ?? 'N/A') ?></p>
                    <p><strong>Father's Middle Name:</strong>
                        <?= htmlspecialchars($parents['father_lastname'] ?? 'N/A') ?>,
                        <?= htmlspecialchars($parents['father_middlename'] ?? 'N/A') ?>
                        <?= htmlspecialchars($parents['father_occupation'] ?? 'N/A') ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Save button -->
        <div class="text-center mt-4">
            <!-- Save button -->
            <div class="text-center mt-4">
                <a href="parents_form" class="btn btn-danger">Back</a>
                <button type="button" id="saveBtn" class="btn btn-success">Save</button>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#saveBtn').click(function () {
                // Collect applicant and parent information from the session
                const applicant = <?= json_encode($applicant) ?>;
                const parents = <?= json_encode($parents) ?>;

                // Combine both objects to send in a single request
                const formData = {
                    applicant: applicant,
                    parents: parents
                };

                Swal.fire({
                    title: "Processing...",
                    html: "Submitting application.",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        Swal.showLoading();
                    },
                });
                $.ajax({
                    url: '../../controller/form/submit_form.php',
                    type: 'POST',
                    data: JSON.stringify(formData), // Convert data to JSON string
                    contentType: 'application/json', // Set content type to JSON
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: "Form submitted successfully",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Ok"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'success_form';
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("Error details:", xhr, status, error); // Log error details
                        alert("An error occurred while submitting the form: " + error);
                    }
                });
            });
        });

    </script>

</body>

</html>