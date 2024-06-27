<?php

require "./utilities/mail.php";


// DONT WORK IN TEMP FOLDER


// send_announcement_mail("ekinduranov@gmail.com", "Fit Gelsin Doğrulama Kodu", "Fit Gelsin üyeliği için doğrulama kodunuz: <b>123456</b>");


$order = [

    "name" => "Name",
    "phone" => "Phone",
    "menu_name" => "Menu Name",
    "date" => "Date",
    "days" => "Days",
    "time" => "Time 12345 678",
    "amount" => "Amount",
    "province" => "Province",
    "district" => "District",
    "address" => "Address ABCDE FGH 12345 678 90"


];

send_order_mail("ekinaslant@gmail.com", "Fit Gelsin Sipariş", "Siparişiniz başarıyla alınmıştır, sipariş ile ilgili detaylı bilgileri aşağıdan görüntüleyebilirsiniz. Faturanız kayıtlı e-posta adresinize iletilecektir.", $order);



echo "TAMAM";







// FROM PAYMENT.PHP

// send_mail("ekinaslant@gmail.com", "TEST", http_build_query($order, '', ' '));