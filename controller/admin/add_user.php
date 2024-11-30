<?php
session_start();
require_once "../../db/connect.php";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    // Validate passwords match
    if ($password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Passwords do not match."]);
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO user (username, gmail, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $gmail, $hashed_password);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

