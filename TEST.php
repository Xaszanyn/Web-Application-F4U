<?php

require "./utilities/mail.php";


send_announcement_mail("ekinduranov@gmail.com", "Fit Gelsin Doğrulama Kodu", "Fit Gelsin üyeliği için doğrulama kodunuz: <b>123456</b>");

echo "TAMAM";

// send_mail_text("e001010011100101110111@gmail.com", "Doğrulama Kodu", "Üyelik için doğrulama kodunuz <b>" . "12345" . "</b>.");