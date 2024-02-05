<?php

require "./utilities/post.php";

$request = post();

$file = fopen("OUTPUT   .txt", "w");
fwrite($file, implode(", ", array_keys($request)) . "\n");
fwrite($file, implode(", ", $request));
fclose($file);

?>