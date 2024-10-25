<?php
session_start();
require_once "../../db/connect.php";

if (!isset($_SESSION['username'])) {
    header("location: ../../view/auth/login.php");
    exit;
}

try {
    $applicantQuery = "
            SELECT applicant.id, 
            applicant.firstname, 
            applicant.middlename, applicant.lastname,
            applicant.email,
            applicant.sex,
            applicant.age,
            applicant.birthdate,
            applicant.height,
            applicant.weight,   
            applicant.status as civil_status,
            applicant.citizenship,
            applicant.barangay,
            applicant.municipality,
            applicant.province,
            applicant.country,
            applicant.parents_id,
            application.id as application_id,
            application.status
            FROM applicant
            INNER JOIN application ON applicant.id = application.applicant_id
            WHERE applicant.id = ?
        ";

    $stmt = $conn->prepare($applicantQuery);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $applicantResult = $stmt->get_result();


    if ($applicantResult) {
        // Fetch the result as an associative array
        $applicant = $applicantResult->fetch_assoc();

        $parentsQuery = "
        SELECT * FROM parents_background
            WHERE id = ?
        ";

        $stmt = $conn->prepare($parentsQuery);
        $stmt->bind_param("i", $applicant['parents_id']);
        $stmt->execute();
        $parentResult = $stmt->get_result();

        if($parentResult) {
            $applicantParents = $parentResult->fetch_assoc();

            echo json_encode(['applicant' => $applicant, 'parent' => $applicantParents]);
        }

        // Echo the JSON-encoded result
    } else {
        // If there was an error in the query, echo an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}