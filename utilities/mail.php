<?php

function send_mail($target, $subject, $mail)
{
    mail($target, $subject, $mail, [
        "From" => "Fit Gelsin <no-reply@fitgelsin.com>",
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=UTF-8"
    ]);
}

function send_announcement_mail($target, $subject, $message, $name = "")
{
    $mail = file_get_contents("./utilities/mails/message.html");
    $mail = str_replace('${name}', empty($name) ? "" : " " . $name, $mail);
    $mail = str_replace('${message}', $message, $mail);

    send_mail($target, $subject, $mail);
}

function send_order_mail($target, $subject, $message, $order)
{
    $mail = file_get_contents("./mails/order.html");
    $mail = str_replace('${name}', empty($order["name"]) ? "" : " " . $order["name"], $mail);
    $mail = str_replace('${message}', $message, $mail);

    echo $mail;

    $order = "<p>İsim:</p><p>{$order["name"]}</p><p>Telefon:</p><p>{$order["phone"]}</p><p>Menü:</p><p>{$order["menu_name"]}</p><p>Sipariş Tarihi:</p><p>{$order["date"]}</p><p>Gün Sayısı:</p><p>{$order["days"]}</p><p>Saat Aralığı:</p><p>{$order["time"]}</p><p>Adet:</p><p>{$order["amount"]}</p><p>İl:</p><p>{$order["province"]}</p><p>İlçe</p><p>{$order["district"]}</p><p>Adres:</p><p>{$order["address"]}</p>";
    $mail = str_replace('${order}', $order, $mail);

    send_mail($target, $subject, $mail);
}