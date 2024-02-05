<?php

require "./utilities/post.php";



$file = fopen("OUTPUT.txt", "w");


fwrite($file, implode(", ", array_keys($_POST)) . "\n");
fwrite($file, implode(", ", $_POST));


// $request = post();


// fwrite($file, implode(", ", array_keys($request)) . "\n");
// fwrite($file, implode(", ", $request));
fclose($file);

?>