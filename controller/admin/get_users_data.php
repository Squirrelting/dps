<?php
session_start();
require_once "../../db/connect.php";
// Fetch the admin details from the database
$query = "SELECT id, username, gmail FROM user";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error retrieving admin details: " . mysqli_error($conn);
    exit;
}

$users = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($users);