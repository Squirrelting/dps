<?php
// Start the session
session_start();

require_once "../../../db/connect.php";

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("location: ../landingpage.php");
    exit;
}

// Fetch the admin details from the database
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    if (!$row) {
        // Handle the case where no admin details were found
        echo "Error: No admin details found.";
        exit;
    }
} else {
    // Handle the case where the query failed
    echo "Error retrieving admin details: " . mysqli_error($conn);
    exit;
}

// Initialize variables with default values
$username = $row['username'];
$gmail = $row['gmail'];
$id = $row['id'];
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        .input-group {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h1 class="text-center mb-4">Edit Admin Details</h1>
            <form id="admin_details" onsubmit="createUser(); return false">
                <div class="mb-3">
                    <label for="username" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="<?php echo htmlspecialchars($username); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="gmail" class="form-label">Gmail:</label>
                    <input type="email" class="form-control" id="gmail" name="gmail" placeholder="Enter your Gmail"
                        value="<?php echo htmlspecialchars($gmail); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="old-password" class="form-label">Old Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="old-password" name="old_password"
                            placeholder="Enter old password" required>
                        <i class="bx bx-show eye-icon" id="old-password-icon"
                            onclick="togglePasswordVisibility('old-password', 'old-password-icon')"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="new-password" name="new_password"
                            placeholder="Enter new password" required>
                        <i class="bx bx-show eye-icon" id="new-password-icon"
                            onclick="togglePasswordVisibility('new-password', 'new-password-icon')"></i>
                    </div>
                </div>

                <input type="hidden" id="userId" value="<?php echo $id ?>"/>

                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm New Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirm-password" name="confirm_password"
                            placeholder="Confirm new password" required>
                        <i class="bx bx-show eye-icon" id="confirm-password-icon"
                            onclick="togglePasswordVisibility('confirm-password', 'confirm-password-icon')"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>