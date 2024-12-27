<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require '../vendor/autoload.php';

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
            echo 'success';
        } catch (Exception $e) {
            echo 'Error: ', $mail->ErrorInfo;
        }
    } else {
        echo 'Invalid email';
    }
} else {
    echo 'All fields are required';
}
