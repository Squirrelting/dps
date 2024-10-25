<?php 
session_start();
require_once "../../db/connect.php";

if (!isset($_SESSION['username'])) {
    header("location: ../../view/auth/login.php");
    exit;
}

try {
    $acceptApplicant = "UPDATE application SET status = 'ACCEPTED' WHERE applicant_id = ?";
    $stmt = $conn->prepare($acceptApplicant);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(array(
            'status' => 'success',
            'message' => 'Applicant accepted successfully.'
        ));
    } else {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Failed to accept applicant.'
        ));
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}