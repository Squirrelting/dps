<!-- parents_form.php -->
<?php
session_start();

// Store applicant information in session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['applicant'] = [
        'firstname' => $_POST['firstname'],
        'middlename' => $_POST['middlename'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'age' => $_POST['age'],
        'sex' => $_POST['sex'],
        'birthdate' => $_POST['birthdate'],
        'height' => $_POST['height'],
        'weight' => $_POST['weight'],
        'status' => $_POST['status'],
        'citizenship' => $_POST['citizenship'],
        'barangay' => $_POST['barangay'],
        'municipality' => $_POST['municipality'],
        'province' => $_POST['province'],
        'country' => $_POST['country']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents/Guardian Form</title>
    <link rel="icon" href="image/shield.jpg" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .navbar {
            background-color: #5bc0de; /* Light blue navbar */
        }
        .navbar-brand {
            color: black;
            font-weight: bold;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Light shadow for form */
        }
        h2 {
            color: #343a40; /* Text color */
        }
        .form-label {
            font-weight: 600; /* Bold labels */
        }
        .btn {
            font-size: 16px; /* Larger button text */
        }
        .form-check-label {
            font-weight: 600;
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

<div class="container mt-5">
    <h2 class="text-center mb-4">Parents/Guardian Background</h2>
    <form action="review_form.php" method="post">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="mother_firstname" class="form-label">Mother's First Name:</label>
                <input type="text" class="form-control" id="mother_firstname" name="mother_firstname">
            </div>
            <div class="col-md-4">
                <label for="mother_middlename" class="form-label">Mother's Middle Name:</label>
                <input type="text" class="form-control" id="mother_middlename" name="mother_middlename">
            </div>
            <div class="col-md-4">
                <label for="mother_lastname" class="form-label">Mother's Last Name:</label>
                <input type="text" class="form-control" id="mother_lastname" name="mother_lastname">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="mother_occupation" class="form-label">Mother's Occupation:</label>
                <input type="text" class="form-control" id="mother_occupation" name="mother_occupation">
            </div>
            <div class="col-md-4">
                <label for="father_firstname" class="form-label">Father's First Name:</label>
                <input type="text" class="form-control" id="father_firstname" name="father_firstname">
            </div>
            <div class="col-md-4">
                <label for="father_middlename" class="form-label">Father's Middle Name:</label>
                <input type="text" class="form-control" id="father_middlename" name="father_middlename">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="father_lastname" class="form-label">Father's Last Name:</label>
                <input type="text" class="form-control" id="father_lastname" name="father_lastname">
            </div>
            <div class="col-md-4">
                <label for="father_occupation" class="form-label">Father's Occupation:</label>
                <input type="text" class="form-control" id="father_occupation" name="father_occupation">
            </div>
        </div>

        <!-- Save button -->
        <div class="row mb-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Next</button>
            </div>
        </div>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
