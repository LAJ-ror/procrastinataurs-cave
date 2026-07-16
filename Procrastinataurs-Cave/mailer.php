<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

function sendVerificationEmail($email, $token)
{
    $mail = new PHPMailer(true);

    try {

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // CHANGE THESE LATER
        $mail->Username   = 'YOURGMAIL@gmail.com';
        $mail->Password   = 'YOUR_GMAIL_APP_PASSWORD';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender
        $mail->setFrom(
            'YOURGMAIL@gmail.com',
            "Procrastinataurs' Cave"
        );

        // Receiver
        $mail->addAddress($email);

        // Email
        $mail->isHTML(true);

        $mail->Subject = "Verify Your Account";

        $link =
        "http://localhost/final-proj/procrastinataurs-cave/Procrastinataurs-Cave/confirm.php?token=".$token;

        $mail->Body = "

        <h2>Welcome to Procrastinataurs' Cave!</h2>

        <p>Click the button below to verify your account.</p>

        <a href='$link'
        style='
        background:#212529;
        color:white;
        padding:12px 20px;
        text-decoration:none;
        border-radius:5px;'>

        Verify Account

        </a>

        ";

        $mail->send();

        return true;

    }
    catch (Exception $e)
    {

        return false;

    }

}
?>