<?php

function send_mail($subject, $message)
{
    mail("ekinaslant@gmail.com", $subject, $message, [
        "From" => "Fit Gelsin <no-reply@fitgelsin.com>",
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=iso-8859-1"
    ]);
}



send_mail("sub", "mes");

echo "test";



// use PHPMailer\PHPMailer\PHPMailer;


// $mail = new PHPMailer(true);
// $mail->isSMTP();
// $mail->Host = "fitgelsin.com";
// $mail->SMTPAuth = true;
// $mail->Username = "noreply@fitgelsin.com";
// $mail->Password = "C91YaYS(V&;~";
// $mail->SMTPSecure = 'ssl';
// $mail->Port = 465;
// $mail->setFrom("noreply@fitgelsin.com", "Fit Gelsin");
// $mail->addAddress("ekinaslant@gmail.com");
// $mail->isHTML(true);
// $mail->Subject = 'Test Email';
// $mail->Body = 'This is a test email sent via PHPMailer';
// $mail->send();

// echo "test2";

?>