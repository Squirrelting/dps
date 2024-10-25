<?php
session_start();

function logout() {
    // Unset the specific session variable
    unset($_SESSION['username']);
}

// Call the logout function
logout();

// Redirect the user to the login page or any other desired page after logout
header("Location: ../../view/auth/login.php");
exit();