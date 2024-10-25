<?php
session_start();
require_once "connect.php";

// Retrieve form data
$name = $_POST["admin_username"];
$password = $_POST["admin_password"];

// Check if the username exists
$sql = "SELECT * FROM tbl_admin WHERE BINARY admin_username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    $response = array(
        'status' => 'error',
        'message' => 'Username not found.'
    );
} else {
    $user = mysqli_fetch_assoc($result);

    // Verify password
    if (!password_verify($password, $user['admin_password'])) {
        $response = array(
            'status' => 'error',
            'message' => 'Incorrect Password.'
        );
    } else {
        // Set the admin_password session variable
        $_SESSION['admin_password'] = $user['admin_password'];
        $response = array(
            'status' => 'success',
            'redirect' => 'index.php?page=dashboard'
        );
    }
}

echo json_encode($response);
exit();
