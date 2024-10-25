<?php
// submit_form.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../db/connect.php';

try {
    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    $applicant = $data['applicant'];
    $parents = $data['parents'];

    // Check applicant data for debugging
    error_log(print_r($applicant, true)); // Log applicant data

    $sql_parents = "INSERT INTO parents_background (mother_firstname, mother_middlename, mother_lastname, mother_occupation, father_firstname, father_middlename, father_lastname, father_occupation)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_parents = $conn->prepare($sql_parents);
    $stmt_parents->bind_param(
        "ssssssss",
        $parents['mother_firstname'],
        $parents['mother_middlename'],
        $parents['mother_lastname'],
        $parents['mother_occupation'],
        $parents['father_firstname'],
        $parents['father_middlename'],
        $parents['father_lastname'],
        $parents['father_occupation']
    );

    if ($stmt_parents->execute()) {
        $parents_id = $stmt_parents->insert_id;

        $sql_applicant = "INSERT INTO applicant (firstname, middlename, lastname, email, age, sex, birthdate, height, weight, status, citizenship, barangay, municipality, province, country, parents_id, created_at, updated_at)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt_applicant = $conn->prepare($sql_applicant);
        
        // Update the type specifier to match the number of parameters
        $stmt_applicant->bind_param(
            "ssssisssssssssss", // 16 type specifiers
            $applicant['firstname'],
            $applicant['middlename'],
            $applicant['lastname'],
            $applicant['email'],
            $applicant['age'],          // Assuming this is an integer
            $applicant['sex'],
            $applicant['birthdate'],
            $applicant['height'],       // Assuming this is an integer
            $applicant['weight'],       // Assuming this is an integer
            $applicant['status'],
            $applicant['citizenship'],
            $applicant['barangay'],
            $applicant['municipality'],
            $applicant['province'],
            $applicant['country'],
            $parents_id
        );

        if ($stmt_applicant->execute()) {
            echo json_encode(["success" => true, "message" => "Applicant and parents information saved successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error saving applicant: " . $stmt_applicant->error]);
        }

        $stmt_applicant->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error saving parents information: " . $stmt_parents->error]);
    }

    $stmt_parents->close();
    $conn->close();
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}