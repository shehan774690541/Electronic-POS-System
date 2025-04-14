<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

session_start();

include 'connection.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Step 1: Verify user (this assumes you already validated them)
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Step 2: Send OTP
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.yourdomain.com'; // like smtp.gmail.com or your email provider
            $mail->SMTPAuth   = true;
            $mail->Username   = 'you@yourdomain.com'; // your business email
            $mail->Password   = 'your-email-password';
            $mail->SMTPSecure = 'tls'; // or ssl
            $mail->Port       = 587;  // or 465 for ssl

            $mail->setFrom('you@yourdomain.com', 'electroSH');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body    = "Your OTP code is: <strong>$otp</strong>";

            $mail->send();
            header("Location: otp.php");
            exit();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Please fill all fields.";
    }
}
?>
