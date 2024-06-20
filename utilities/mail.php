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
    $mail = file_get_contents("https://fitgelsin.com/services/utilities/mails/order.html");
    $mail = str_replace('${name}', empty($order["name"]) ? "" : " " . $order["name"], $mail);
    $mail = str_replace('${message}', $message, $mail);

    $order = "<p style='text-align: right; font-weight: bold;'>İsim:</p><p>{$order["name"]}</p><p style='text-align: right; font-weight: bold;'>Telefon:</p><p>{$order["phone"]}</p><p style='text-align: right; font-weight: bold;'>Menü:</p><p>{$order["menu_name"]}</p><p style='text-align: right; font-weight: bold;'>Sipariş Tarihi:</p><p>{$order["date"]}</p><p style='text-align: right; font-weight: bold;'>Gün Sayısı:</p><p>{$order["days"]}</p><p style='text-align: right; font-weight: bold;'>Saat Aralığı:</p><p>{$order["time"]}</p><p style='text-align: right; font-weight: bold;'>Adet:</p><p>{$order["amount"]}</p><p style='text-align: right; font-weight: bold;'>İl:</p><p>{$order["province"]}</p><p style='text-align: right; font-weight: bold;'>İlçe</p><p>{$order["district"]}</p><p style='text-align: right; font-weight: bold;'>Adres:</p><p>{$order["address"]}</p>";
    $mail = str_replace('${order}', $order, $mail);

    send_mail($target, $subject, $mail);
}