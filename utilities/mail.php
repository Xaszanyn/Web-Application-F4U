<?php

function send_mail_text($target, $subject, $message, $name = "")
{
    $mail = file_get_contents("./utilities/mail.html");

    $mail = str_replace('${name}', empty($name) ? "" : " " . $name, $mail);
    $mail = str_replace('${message}', $message, $mail);

    mail($target, $subject, $mail, [
        "From" => "Fit Gelsin <no-reply@fitgelsin.com>",
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=iso-8859-1"
    ]);
}

function send_mail($target, $subject, $message, $name = "")
{
    $message = ($name ? "Merhaba " . $name . ", " : $name) . $message;

    mail($target, $subject, $message, [
        "From" => "Fit Gelsin <no-reply@fitgelsin.com>",
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=iso-8859-1"
    ]);
}

// Next time, try mail with logging!