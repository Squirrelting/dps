<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISELCO 1</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- sweet alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/login.css?v=<?php echo time(); ?>">
    <link rel="icon" href="image/shield.jpg" rel="shortcut icon" type="image/vnd.microsoft.icon">
</head>

<body>
    <div class="container">
        <div class="icon-container">
            <img src="../../image/shield.jpg" alt="Icon">
        </div>
        <h2>HERO SECURITY AND INVESTIGATION SERVICES OFFICE</h2>
        <p class="top-text">Admin Portal</p>

        <form method="POST" name="login" id="login">
            <input type="text" name="admin_username" placeholder="Username" required>
            <div class="password-input">
                <input type="password" name="admin_password" id="password" placeholder="Password" required>
                <i class="bx bx-show eye-icon" id="show-password" onclick="togglePasswordVisibility()"></i>
            </div>
            <input type="submit" name="login" value="Login">
            <p class="forgot-password">Forgot your password? <a href="fpassword.php"> Reset it</a></p>
        </form>
    </div>
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const showPasswordIcon = document.getElementById("show-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordIcon.classList.remove("bx-show");
                showPasswordIcon.classList.add("bx-hide");
            } else {
                passwordInput.type = "password";
                showPasswordIcon.classList.remove("bx-hide");
                showPasswordIcon.classList.add("bx-show");
            }
        }

        $(document).ready(function () {
            $('#login').submit(function (event) {
                event.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "../../controller/authentication/login_action.php",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        let data = JSON.parse(response);
                        if (data.status === 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message
                            });
                        } else if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Login successful!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function () {
                                window.location.href = data.redirect;
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>