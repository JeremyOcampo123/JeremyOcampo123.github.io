<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorMessage = ''; // Initialize the variable

    // Get form data and sanitize
    $username = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Invalid email format';
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $username)) {
        $errorMessage = 'Name must contain only letters and spaces';
    } else {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
           // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mr.red092697@gmail.com';
        $mail->Password = 'ezoavahtxokotkbp';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
            // Sender information
            $mail->setFrom($email, $username);

            // Recipient email
            $mail->addAddress('mr.red092697@gmail.com');  // Change this to the recipient's email address

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Submission';
            $mail->Body    = 'Username: ' . $username . '<br>Email: ' . $email . '<br>Message: ' . $message;

            // Send the email
            $mail->send();

            // Return a success message
            echo 'sent';
        } catch (Exception $e) {
            $errorMessage = 'Error: ' . $e->getMessage();
            // Return an error message
            echo $errorMessage;
        }
    }
} else {
    // Return an error message if accessed directly
    echo 'Direct access not allowed';
}
?>
