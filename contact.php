<?php
require 'vendor/autoload.php'; // Include Composer's autoloader
require 'assets/database/database.php'; // Include your database connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = ''; // Initialize the variable

    // Get form data
    $username = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format';
        exit();
    }

    // Validate name consisting of letters only
    if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
        echo 'Name must contain only letters and spaces';
        exit();
    }

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

        // Insert into the database
        $query = "INSERT INTO users (username, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $username, $email, $message);
        $stmt->execute();
        $stmt->close();

        $message = 'Message has been sent and saved to the database';
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
} else {
    header('Location: index.html');  // Redirect if accessed directly
}
?>
