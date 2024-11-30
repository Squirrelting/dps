<?php
session_start();
require_once "../../db/connect.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("location: ../../view/landingpage.php");
    exit;
}

$id = $_POST['id'];
$query = "SELECT * FROM user WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
if ($stmt === false) {
    echo json_encode(array('status' => 'error', 'message' => 'Database error: ' . mysqli_error($conn)));
    exit;
}
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'No admin details found or query failed.'));
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $gmail = $_POST['gmail'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $hashedOldPassword = password_hash($old_password, PASSWORD_DEFAULT);

    // Verify old password
    if (!password_verify($old_password, $hashedOldPassword)) {
        echo json_encode(array('status' => 'error', 'message' => 'Old password is incorrect.'));
        exit;
    }

    // Validate new password requirements
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d|\W).{8,}$/', $new_password)) {
        echo json_encode(array('status' => 'error', 'message' => 'Password must be at least 8 characters long and contain at least one letter and one number or symbol.'));
        exit;
    }

    // Confirm passwords match
    if ($new_password !== $confirm_password) {
        echo json_encode(array('status' => 'error', 'message' => 'Passwords do not match.'));
        exit;
    }

    // Update user information
    $update_query = "UPDATE user SET username = ?, gmail = ?, password = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    mysqli_stmt_bind_param($stmt, 'sssi', $username, $gmail, $hashed_password, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(array('status' => 'success', 'message' => 'Details updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating details: ' . mysqli_stmt_error($stmt)));
    }

    mysqli_stmt_close($stmt);
}


