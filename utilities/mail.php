<?php

function send_mail($target, $subject, $message, $name = "")
{
    $mail = file_get_contents("./utilities/mail.html");

    str_replace('${name}', empty ($name) ? "" : " " . $name, $mail);
    str_replace('${message}', $message, $mail);

    echo $mail;

    mail($target, $subject, $mail, [
        "From" => "Fit Gelsin <no-reply@fitgelsin.com>",
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=iso-8859-1"
    ]);
}


send_mail("e001010011100101110111@gmail.com", "TEST MAIL", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum earum obcaecati unde quas, quam ipsa debitis expedita sint distinctio illo?", "Ekin");