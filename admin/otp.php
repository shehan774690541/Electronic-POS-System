<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

include 'connection.php'; // optional, only if you need DB

if (isset($_COOKIE['MAIL']) && isset($_COOKIE['OTP'])) {
    $email = $_COOKIE['MAIL'];
    $otp = $_COOKIE['OTP'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'devshehan41@gmail.com';           // YOUR Gmail
        $mail->Password   = 'pw';       // 💥 Replace with App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email details
        $mail->setFrom('devshehan41@gmail.com', 'electroSH');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code is: <strong>$otp</strong>";

        $mail->send();

        echo "✅ OTP has been sent to <b>$email</b>";

    } catch (Exception $e) {
        echo "❌ Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "❌ Email or OTP not found. Please login first.";
}
?>
