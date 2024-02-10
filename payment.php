<?php

require "./utilities/post.php";

$payment = post(true);



$file = fopen("OUTPUT.txt", "w");
fwrite($file, implode(", ", array_keys($payment)) . "\n");
fwrite($file, implode(", ", $payment));
fclose($file);

?>