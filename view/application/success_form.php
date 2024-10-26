<?php
session_start();
    if(!isset($_SESSION['application_success'])){
        header("location: ../../view/application/applicant_form");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Submission</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="icon" href="image/shield.jpg" type="image/vnd.microsoft.icon">

    <style>
        .review-info p {
            margin: 0.2rem 0;
        }

        .navbar {
            background-color: #5bc0de;
        }

        .navbar-brand {
            color: black;
            font-weight: bold;
        }

        .section-header {
            color: #007bff;
        }

        .thank-you-message {
            text-align: center;
            margin-top: 50px;
        }

        .back-home-btn {
            display: block;
            margin: 30px auto;
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

    <!-- Thank You Message -->
    <div class="container mt-5">
        <div class="thank-you-message">
            <h2>Thank You for Submitting Your Application!</h2>
            <p>Your application has been successfully submitted. We will review your information and get back to you
                soon.</p>
            <p>If you have any questions, feel free to contact us.</p>
        </div>

        <!-- Back to Home Button -->
        <a href="../landingpage" class="btn btn-primary back-home-btn">Back to Home</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>