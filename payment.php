<?php

require "./utilities/post.php";
require "./utilities/database.php";

$request = post(true);

$email = create_order($request);

mail($email, "Fit4U", $request["paymesOrderId"] . " numaralı siparişinizin ödemesi başarıyla alınmıştır. İyi günler dileriz.");