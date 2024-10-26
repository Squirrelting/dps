<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="icon" href="image/shield.jpg" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="vendor/select2/dist/js/select2.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            /* Light gray background */
        }

        .navbar {
            background-color: #28a745;
            /* Light blue navbar */
        }

        .navbar-brand {
            color: black;
            font-weight: bold;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            /* Light shadow for form */
        }

        h2 {
            color: #343a40;
            /* Text color */
        }

        .form-label {
            font-weight: 600;
            /* Bold labels */
        }

        .btn {
            font-size: 16px;
            /* Larger button text */
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
            <a class="navbar-brand" href="../landingpage.php">HERO SECURITY AND INVESTIGATION SERVICES</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Personal Information Form</h2>
        <form action="parents_form.php" method="post">
            <!-- Form fields in 3 columns -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="firstname" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                        value="<?php echo $_SESSION['applicant']['firstname'] ?? '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="middlename" class="form-label">Middle Name:</label>
                    <input value="<?php echo $_SESSION['applicant']['middlename'] ?? '' ?>" type="text"
                        class="form-control" id="middlename" name="middlename">
                </div>
                <div class="col-md-4">
                    <label for="lastname" class="form-label">Last Name:</label>
                    <input value="<?php echo $_SESSION['applicant']['lastname'] ?? '' ?>" type="text"
                        class="form-control" id="lastname" name="lastname" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="age" class="form-label">Age:</label>
                    <input value="<?php echo $_SESSION['applicant']['age'] ?? '' ?>" type="number" class="form-control"
                        id="age" name="age" required>
                </div>
                <div class="col-md-4">
                    <label for="sex" class="form-label">Sex:</label>
                    <select class="form-select" id="sex" name="sex" required>
                        <?php if ($_SESSION['applicant']['sex']) {
                            echo '<option value="' . $_SESSION['applicant']['sex'] . '">' . $_SESSION['applicant']['sex'] . '</option>';
                        } ?>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="birthdate" class="form-label">Birthdate:</label>
                    <input value="<?php echo $_SESSION['applicant']['birthdate'] ?? '' ?>" type="date"
                        class="form-control" id="birthdate" name="birthdate" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="height" class="form-label">Height (cm):</label>
                    <input type="number" value="<?php echo $_SESSION['applicant']['height'] ?? '' ?>"
                        class="form-control" id="height" name="height" required>
                </div>
                <div class="col-md-4">
                    <label for="weight" class="form-label">Weight (kg):</label>
                    <input type="number" value="<?php echo $_SESSION['applicant']['weight'] ?? '' ?>"
                        class="form-control" id="weight" name="weight" required>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Marital Status:</label>
                    <select class="form-select" id="status" name="status" required>
                        <?php if ($_SESSION['applicant']['status']) {
                            echo '<option value="' . $_SESSION['applicant']['status'] . '">' . $_SESSION['applicant']['status'] . '</option>';
                        } ?>
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
                    <input type="text" value="<?php echo $_SESSION['applicant']['citizenship'] ?? '' ?>" class="form-control" id="citizenship" name="citizenship" required>
                </div>

                <div class="col-md-4">
                    <label for="country" class="form-label">Country:</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?php echo $_SESSION['applicant']['country'] ?? 'Philippines' ?>" required>
                </div>

                <div class="col-md-4">
                    <label for="barangay" class="form-label">Provice:</label>
                    <select name="province" class="js-example-basic-single form-select"
                        onchange="getCitiesMunicipalities(null, null)" id="provincesData" aria-label="Default select example"
                        required>

                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="barangay" class="form-label">City/Municipality:</label>
                    <select name="municipality" class="js-example-basic-single form-select" onchange="getBarangays(null)"
                        aria-label="Default select example" id="citiesData" required>
                        <option selected>Please select province first</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="province" class="form-label">Barangay:</label>
                    <select name="barangay" class="js-example-basic-single form-select"
                        aria-label="Default select example" id="barangaysData" required>
                        <option selected>Please select City/Municipality first</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" value="<?php echo $_SESSION['applicant']['email'] ?? '' ?>" class="form-control" id="email" name="email" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="../landingpage" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Next</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../view/js/application/application_form.js?v=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });
    window.onload = function () {
        const sessionProvince = <?php echo json_encode($_SESSION['applicant']['province'] ?? ''); ?>;
        const sessionCity = <?php echo json_encode($_SESSION['applicant']['municipality'] ?? ''); ?>;
        const sessionBarangay = <?php echo json_encode($_SESSION['applicant']['barangay'] ?? ''); ?>;
        if(sessionProvince != '') {
            getProvinces(sessionProvince, sessionCity, sessionBarangay);
        } else {
            getProvinces(null, null, null);
        }
    }
</script>

</html>