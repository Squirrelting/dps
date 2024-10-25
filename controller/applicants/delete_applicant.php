<?php
session_start();
require_once "../../db/connect.php";

if (!isset($_SESSION['username'])) {
    header("location: ../../view/auth/login.php");
    exit;
}

try {
    $deleteApplicant = "DELETE FROM applicant WHERE id = ?";
    $stmt = $conn->prepare($deleteApplicant);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(array(
            'status' => 'success',
            'message' => 'Applicant deleted successfully.'
        ));
    } else {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Failed to delete applicant.'
        ));
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
    