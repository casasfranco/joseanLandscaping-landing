<?php
/* --------------------------------------------------------------------------
 *
 * file           : sendmail.php
 * Desc           : Sendmail Contact Form
 * Version        : 1.1
 * Date           : 11/13/2020
 * Author         : Imam Firmansyah
 * Author URI     : http://imamfirmansyah.com
 * Email          : imamfirmansyah27@gmail.com
 *
 * Copyright 2020. All Rights Reserved.
 * -------------------------------------------------------------------------- */

/* ==========================================================================
    Variables you can change
========================================================================== */

// Enter your mail addres here
$mailfrom = "info@joseanlandscaping.com";
$mailto = "info@joseanlandscaping.com";
$replyto = $mailto;

$name = ucwords($_POST["name"]);
$subject = $_POST["subject"]; // Enter the subject here.
$email = $_POST["email"];
$message = $_POST["message"];
$email_message = "";

if (strlen($name) < 1) {
    echo "email_error : unknown name";
} elseif (strlen($email) < 1) {
    echo "email_error  : unknown email";
} elseif (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
    echo "email_error : unknown email format";
} elseif (strlen($message) < 1) {
    echo "email_error : unknown email message";
} else {
    // NOW SEND THE ENQUIRY
    $email_message .= "From : " . $name . " <" . $email . ">\r\n";
    $email_message .= "Subject : " . $subject . "\r\n";
    $email_message .= "Message : " . $message . "\r\n";
    $email_message .= "-- \r\n";
    $email_message .= "This e-mail was sent from a contact form on JoseanLandscaping - HTML Contact Form (https://themedemo.foundstrap.com/JoseanLandscaping)";

    // To send HTML mail, the Content-type header must be set
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8" . "\r\n";

    // Additional headers
    $headers .= "From: Foundstrap <" . $mailfrom . ">" . "\r\n";
    $headers .= "Reply-To: " . $name . " <" . $email . ">" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // to JoseanLandscaping
    mail($mailto, "[JoseanLandscaping] Contact Form - " . $subject, $email_message, $headers);

    /* ------------------------------------------------------------------------------------------------ */
    // to sender

    // To send HTML mail, the Content-type header must be set
    $headers_sender = "MIME-Version: 1.0" . "\r\n";
    $headers_sender .= "Content-Type: text/plain; charset=utf-8" . "\r\n";

    // Additional headers
    $headers_sender .= "From: Foundstrap <" . $mailfrom . ">" . "\r\n";
    $headers_sender .= "Reply-To: JoseanLandscaping <" . $replyto . ">" . "\r\n";
    $headers_sender .= "X-Mailer: PHP/" . phpversion();

    $email_message_sender = "Hi " . $name . ",\r\n";
    $email_message_sender .= "Thank you for reaching us, we will reply back to you ASAP\r\n";
    $email_message_sender .= "-- \r\n";
    $email_message_sender .= "This e-mail was sent from a contact form on JoseanLandscaping";

    mail($email, "[JoseanLandscaping] Contact Form - " . $subject, $email_message_sender, $headers_sender);
}
?>
