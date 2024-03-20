<?php

function send_mail($subject, $message, $name = "")
{
    $html = file_get_contents("./mail.html");

    str_replace('${name}', empty ($name) ? "" : " " . $name, $html);
    str_replace('${message}', $message, $html);

    mail("ekinaslant@gmail.com", $subject, $message, [
        "From" => "Fit Gelsin <no-reply@fitgelsin.com>",
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=iso-8859-1"
    ]);
}

send_mail("Doğrulama Kodu", "Üyelik için doğrulama kodunuz <b>21445</b>.", "Ekin Aslan");