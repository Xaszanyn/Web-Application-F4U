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

    $order = "<span style='text-align: right; font-weight: bold;'>İsim:</span><span>{$order["name"]}</span><span style='text-align: right; font-weight: bold;'>Telefon:</span><span>{$order["phone"]}</span><span style='text-align: right; font-weight: bold;'>Menü:</span><span>{$order["menu_name"]}</span><span style='text-align: right; font-weight: bold;'>Sipariş Tarihi:</span><span>{$order["date"]}</span><span style='text-align: right; font-weight: bold;'>Gün Sayısı:</span><span>{$order["days"]}</span><span style='text-align: right; font-weight: bold;'>Saat Aralığı:</span><span>{$order["time"]}</span><span style='text-align: right; font-weight: bold;'>Adet:</span><span>{$order["amount"]}</span><span style='text-align: right; font-weight: bold;'>İl:</span><span>{$order["province"]}</span><span style='text-align: right; font-weight: bold;'>İlçe:</span><span>{$order["district"]}</span><span style='text-align: right; font-weight: bold;'>Adres:</span><span>{$order["address"]}</span>";
    $mail = str_replace('${order}', $order, $mail);

    send_mail($target, $subject, $mail);
}