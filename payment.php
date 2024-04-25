<?php

require "./utilities/post.php";
require "./utilities/database.php";
require "./utilities/mail.php";

$request = post(true);

$email = create_order($request);

// send_mail($email);
// $request["paymesOrderId"] . " numaralı siparişinizin ödemesi başarıyla alınmıştır. İyi günler dileriz."