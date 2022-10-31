<?php

use Config\Email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($to, $title, $message)
{
    $email = \Config\Services::email();

    $email->setFrom('leges@fmipa.unsyiah.ac.id', 'FMIPA USK');
    $email->setTo($to);

    $email->setSubject($title);
    $email->setMessage($message);

    if (!$email->send()) {
        return $email->printDebugger();
    } else {
        return true;
    }
}
