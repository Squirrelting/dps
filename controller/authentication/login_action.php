<?php
session_start();
require_once "../../db/connect.php";

class Authentication {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($username, $password) {
        // Prepare SQL query to check if the username exists
        $sql = "SELECT * FROM user WHERE BINARY username = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if user exists
        if (mysqli_num_rows($result) == 0) {
            return array(
                'status' => 'error',
                'message' => 'Username not found.'
            );
        } else {
            $user = mysqli_fetch_assoc($result);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Verify password using password_verify
            if (!password_verify($password, $hashedPassword)) {
                return array(
                    'status' => 'error',
                    'message' => 'Incorrect Password.'
                );
            } else {
                // Set session variable
                $_SESSION['username'] = $user['username']; // Store username or any other user data
                return array(
                    'status' => 'success',
                    'redirect' => '../../view/auth/index.php?page=dashboard'
                );
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Authentication($conn);
    $username = $_POST["admin_username"];
    $password = $_POST["admin_password"];

    $response = $auth->login($username, $password);
    echo json_encode($response);
    exit();
}
