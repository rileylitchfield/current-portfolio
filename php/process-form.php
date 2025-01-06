<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require '../vendor/autoload.php';

header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // hCaptcha token sent from the frontend
    $hcaptchaResponse = $_POST['h-captcha-response'] ?? '';

    // Validate hCaptcha response
    if (empty($hcaptchaResponse)) {
        echo json_encode(['status' => 'error', 'message' => 'hCaptcha response is missing.']);
        exit;
    }

    // hCaptcha Secret Key
    $secretKey = getenv('HCAPTCHA_SECRET');

    // Verify the hCaptcha token with hCaptcha's API
    $verificationUrl = 'https://hcaptcha.com/siteverify';
    $response = file_get_contents($verificationUrl . '?secret=' . $secretKey . '&response=' . $hcaptchaResponse);

    if ($response === false) {
        echo json_encode(['status' => 'error', 'message' => 'Error verifying hCaptcha.']);
        exit;
    }

    $responseData = json_decode($response);
    if (!$responseData->success) {
        echo json_encode(['status' => 'error', 'message' => 'hCaptcha verification failed.']);
        exit;
    }

    // Form validation
    if (isset($_POST['name'], $_POST['email'], $_POST['comment'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $comment = htmlspecialchars(trim($_POST['comment']));

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail = new PHPMailer(true);
            $from_email = getenv('FROM_EMAIL');
            $to_email = getenv('TO_EMAIL');

            try {
                // SMTP settings
                $mail->isSMTP();
                $mail->Host = getenv('SMTP_HOST');
                $mail->Port = getenv('SMTP_PORT');
                $mail->Username = getenv('SMTP_USERNAME');
                $mail->Password = getenv('SMTP_PASSWORD');
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';

                // Email settings
                $mail->setFrom($from_email, $name);
                $mail->addAddress($to_email);
                $mail->Subject = 'Contact Request From Website';
                $mail->Body = $comment;

                $mail->send();
                echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully!']);
            } catch (Exception $e) {
                error_log('SMTP Error: ' . $mail->ErrorInfo);
                echo json_encode(['status' => 'error', 'message' => 'Error sending email.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}