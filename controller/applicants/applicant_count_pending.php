<?php 
session_start();
require_once "../../db/connect.php";

if (!isset($_SESSION['username'])) {
    header("location: ../../view/auth/login.php");
    exit;
}

try {
    $query = "
            SELECT COUNT(*) as count
            FROM application
            WHERE status = 'PENDING'
        ";

    $result = $conn->query($query);

    if ($result) {
        // Fetch the result as an associative array
        $applicants = $result->fetch_assoc();

        // Echo the JSON-encoded result
        echo json_encode($applicants);
    } else {
        // If there was an error in the query, echo an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}