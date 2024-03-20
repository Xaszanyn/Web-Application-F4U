<?php

function send_mail($target, $subject, $message, $name = "")
{
    $mail = file_get_contents("./mail.html");

    str_replace('${name}', empty ($name) ? "" : " " . $name, $mail);
    str_replace('${message}', $message, $mail);

    mail($target, $subject, $mail, [
        "From" => "Fit Gelsin <no-reply@fitgelsin.com>",
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=iso-8859-1"
    ]);
}

$mail = file_get_contents("./mail.html");

echo $mail;