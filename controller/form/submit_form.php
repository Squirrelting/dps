<?php
// submit_form.php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../db/connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
$emailConfig = include '../../config/email_config.php';

try {
    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    $applicant = $data['applicant'];
    $parents = $data['parents'];

    // Insert into parents_background
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
        $parents_id = $stmt_parents->insert_id;  // Get the inserted parents_id

        // Insert into applicant
        $sql_applicant = "INSERT INTO applicant (firstname, middlename, lastname, email, age, sex, birthdate, height, weight, status, citizenship, barangay, municipality, province, country, parents_id, created_at, updated_at)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt_applicant = $conn->prepare($sql_applicant);

        // Bind parameters with the correct type specifiers
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
            $applicant_id = $stmt_applicant->insert_id; // Get the inserted applicant_id

            // Insert into application
            $sql_application = "INSERT INTO application (applicant_id, status, interview_date, interview_time)
                                VALUES (?, ?, NULL, NULL)";
            $stmt_application = $conn->prepare($sql_application);

            $status = 'PENDING';
            $stmt_application->bind_param(
                "is",
                $applicant_id,
                $status
            );

            $mail = new PHPMailer(true);

            try {
                // Enable verbose debug output
                $mail->SMTPDebug = 0;

                // Send using SMTP
                $mail->isSMTP();

                // Set the SMTP server to send through
                $mail->Host = 'smtp.gmail.com';

                // Enable SMTP authentication
                $mail->SMTPAuth = true;

                // SMTP username
                $mail->Username = $emailConfig['username'];

                // SMTP password
                $mail->Password = $emailConfig['password'];

                // Enable TLS encryption
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Port = 587;

                // Recipients
                $mail->setFrom($emailConfig['username'], 'DPS');

                // Add a recipient
                $mail->addAddress($applicant['email']);

                // Set email format to HTML
                $mail->isHTML(true);

                $mail->Subject = 'Application Submission Confirmation';
                $mail->Body = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Application Submission Confirmation</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            margin: 20px;
                        }
                        .container {
                            border: 1px solid #ccc;
                            padding: 20px;
                            border-radius: 5px;
                            background-color: #f9f9f9;
                        }
                        .header {
                            font-size: 24px;
                            font-weight: bold;
                            margin-bottom: 10px;
                        }
                        .footer {
                            margin-top: 20px;
                            font-size: 14px;
                            color: #555;
                        }
                    </style>
                </head>
                <body>

                <div class="container">
                    <div class="header">Application Submission Confirmation</div>

                    <p>Dear, ' . $applicant['firstname']  .'</p>

                    <p>Thank you for submitting your application. We are currently reviewing your information and will reach out to you shortly regarding the next steps in the process.</p>
                    <p>We appreciate your interest in joining our team and look forward to connecting with you soon.</p>
                    <p>To edit your application. Please click the link below</p>
                    <a href="#">Click here</a>
                    <div class="footer">
                        Best regards,<br>
                        [Your Name]<br>
                        [Your Position]<br>
                        [Company/Organization Name]<br>
                        [Contact Information]
                    </div>
                </div>

                </body>
                </html>
                ';
                $mail->send();

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            if ($stmt_application->execute()) {
                echo json_encode(["success" => true, "message" => "Applicant and parents information saved successfully."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error saving application: " . $stmt_application->error]);
            }
            $_SESSION['application_success'] = 'TRUE';
            unset($_SESSION['applicant']);
            unset($_SESSION['parents']);
            $stmt_application->close();
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
