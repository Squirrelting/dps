<?php
session_start();
require_once "../../db/connect.php";

if (!isset($_SESSION['username'])) {
    header("location: ../../view/auth/login.php");
    exit;
}

// SQL query to get the count of applicants per day
$query = "
    SELECT DATE(created_at) AS application_date, COUNT(*) AS total_applicants
    FROM applicant
    GROUP BY DATE(created_at)
    ORDER BY application_date ASC
";

// Execute the query
$result = mysqli_query($conn, $query);

// Initialize an array to store results
$data = [];

// Check if the query was successful
if ($result) {
    // Fetch each row as an associative array and add it to $data
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'date' => $row['application_date'],
            'total_applicants' => $row['total_applicants']
        ];
    }

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo json_encode(['error' => mysqli_error($conn)]);
}

// Close the database connection
mysqli_close($conn);
