<?php
session_start();
require_once "../../db/connect.php";

if (!isset($_SESSION['username'])) {
    header("location: ../../view/auth/login.php");
    exit;
}

// SQL query to count the number of applications with status 'PENDING'
$totalQuery = "SELECT COUNT(*) AS total_count FROM application";

$totalResult = mysqli_query($conn, $totalQuery);

if ($totalResult) {
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalApplicants = $totalRow['total_count'];
} else {
    echo "Error: " . mysqli_error($conn);
}

$acceptedQuery = "SELECT COUNT(*) AS accepted_count FROM application WHERE status = 'ACCEPTED'";

$acceptedResult = mysqli_query($conn, $acceptedQuery);

if ($acceptedResult) {
    $acceptedRow = mysqli_fetch_assoc($acceptedResult);
    $acceptedCount = $acceptedRow['accepted_count'];
} else {
    echo "Error: " . mysqli_error($conn);
}

$rejectedQuery = "SELECT COUNT(*) AS rejected_count FROM application WHERE status = 'REJECTED'";

$rejectedResult = mysqli_query($conn, $rejectedQuery);

if ($rejectedResult) {
    $rejectedRow = mysqli_fetch_assoc($rejectedResult);
    $rejectedCount = $rejectedRow['rejected_count'];
} else {
    echo "Error: " . mysqli_error($conn);
}

$data = [
    'totalApplicants' => $totalApplicants,
    'acceptedCount' => $acceptedCount,
    'rejectedCount' => $rejectedCount
];

echo json_encode($data);
// Close the database connection
mysqli_close($conn);
?>
