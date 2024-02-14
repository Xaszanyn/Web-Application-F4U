<?php

require "./utilities/post.php";

$order = post();

// $information = 

$file = fopen("OUTPUT.txt", "w");
fwrite($file, implode(", ", array_keys($order)) . "\n");
fwrite($file, implode(", ", $order));
fclose($file);

?>