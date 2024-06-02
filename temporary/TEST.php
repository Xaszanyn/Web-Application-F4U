<?php

require "../utilities/mail.php";


send_order_mail("ekinduranov@gmail.com", "TEST F4U", "message", [
    "menu_name" => "menu_name",
    "date" => "date",
    "province" => "province",
    "district" => "district",
    "days" => "days",
    "time" => "time",
    "promotion" => "promotion",
    "amount" => "amount",
    "name" => "name",
    "phone" => "phone",
    "email" => "email",
    "address" => "address",
]);

// send_mail_text("e001010011100101110111@gmail.com", "Doğrulama Kodu", "Üyelik için doğrulama kodunuz <b>" . "12345" . "</b>.");