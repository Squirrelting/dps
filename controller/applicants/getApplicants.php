<?php
session_start();
require_once "../../db/connect.php";

if (!isset($_SESSION['username'])) {
    header("location: ../../view/auth/login.php");
    exit;
}
try {
    $query = "
            SELECT applicant.id, 
            applicant.firstname, 
            applicant.middlename, applicant.lastname,
            applicant.email,
            applicant.sex,
            applicant.age,
            application.status
            FROM applicant
            INNER JOIN application ON applicant.id = application.applicant_id
            ORDER BY application.id DESC
        ";

    $result = $conn->query($query);

    if ($result) {
        // Fetch the result as an associative array
        $applicants = $result->fetch_all(MYSQLI_ASSOC);

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


?>