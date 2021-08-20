<?php
//include 'index.php';
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = '9312ebc10be1c3';                     //SMTP username
    $mail->Password = 'c91fd373a47f6d';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Sender
    $mail->setFrom($email, $name);
    //Recipients
    $mail->addAddress('billyhans90@gmail.com', 'Billy Hans');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');


    //Body
    $body = "<p><strong>Hello</strong>, you have a message from " ."<strong>$name</strong>". " the message is <br>". "<strong>$message</strong>". " <br>you can contact on ". $email. "</p>";

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject . 'From' . $name;
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo '<h1 style="color: blue;"><strong>Message sent successfully</strong></h1>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
