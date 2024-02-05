<?php

require "../utilities/post.php";

$order = post();

// $information = 

$file = fopen("output.txt", "w");
fwrite($file, implode(", ", array_keys($request)) . "\n");
fwrite($file, implode(", ", $request));
fclose($file);

?>