<?php
session_start();
require_once "../../db/connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
$emailConfig = include '../../config/email_config.php';

if (!isset($_SESSION['username'])) {
    header("location: ../../view/auth/login.php");
    exit;
}

try {
    $status = 'ACCEPTED';
    $acceptApplicant = "UPDATE application SET status = ?, 
    interview_date = ?, interview_time = ? WHERE applicant_id = ?";
    $stmt = $conn->prepare($acceptApplicant);
    $stmt->bind_param("sssi", $status, $_POST['interviewDate'], $_POST['interviewTime'], $_POST['id']);
    $stmt->execute();

    $getApplicantEmail = "SELECT email FROM applicant WHERE id = ?";
    $stmt = $conn->prepare($getApplicantEmail);
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $applicantEmail = $result->fetch_assoc()['email'];

    if ($stmt->affected_rows > 0) {
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
            $mail->addAddress($applicantEmail);

            // Set email format to HTML
            $mail->isHTML(true);

            $mail->Subject = 'Application Status';
            $mail->Body = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Application Status Update</title>
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
                        <div class="header">Congratulations on Your Application!</div>
                        <p>Dear [Applicant\'s Name],</p>
                        <p>We are pleased to inform you that your application for the position of <strong>[Position/Program Name]</strong> at <strong>[Company/Organization Name]</strong> has been accepted!</p>
                        <p>Your qualifications and experiences stood out to us, and we are excited to welcome you to our team. Further details regarding the next steps in the onboarding process will be sent to you shortly.</p>
                        <p>Thank you for your interest in joining <strong>[Company/Organization Name]</strong>. We look forward to working together!</p>
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
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


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