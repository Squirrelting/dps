<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="icon" href="image/shield.jpg" rel="shortcut icon" type="image/vnd.microsoft.icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
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
    <h2 class="text-center mb-4">Personal Information Form</h2>
    <form action="parents_form.php" method="post">
        <!-- Form fields in 3 columns -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="col-md-4">
                <label for="middlename" class="form-label">Middle Name:</label>
                <input type="text" class="form-control" id="middlename" name="middlename">
            </div>
            <div class="col-md-4">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="col-md-4">
                <label for="sex" class="form-label">Sex:</label>
                <select class="form-select" id="sex" name="sex" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="birthdate" class="form-label">Birthdate:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="height" class="form-label">Height (cm):</label>
                <input type="number" class="form-control" id="height" name="height" required>
            </div>
            <div class="col-md-4">
                <label for="weight" class="form-label">Weight (kg):</label>
                <input type="number" class="form-control" id="weight" name="weight" required>
            </div>
            <div class="col-md-4">
                <label for="status" class="form-label">Marital Status:</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Separated">Separated</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="citizenship" class="form-label" placeholder="ex. Filipino">Citizenship:</label>
                <input type="text" class="form-control" id="citizenship" name="citizenship" required>
            </div>
            <div class="col-md-4">
                <label for="barangay" class="form-label">Barangay:</label>
                <input type="text" class="form-control" id="barangay" name="barangay" required>
            </div>
            <div class="col-md-4">
                <label for="municipality" class="form-label">Municipality:</label>
                <input type="text" class="form-control" id="municipality" name="municipality" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="province" class="form-label">Province:</label>
                <input type="text" class="form-control" id="province" name="province" required>
            </div>
            <div class="col-md-4">
                <label for="country" class="form-label">Country:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row mb-3">
            <div class="col-md-12">
            <button type="submit" class="btn btn-success">Next</button>
            </div>
        </div>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
