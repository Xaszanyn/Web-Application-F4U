<?php

require "../utilities/post.php";

$mail = post()["email"];



echo json_encode(["v" => filter_var($mail, FILTER_VALIDATE_EMAIL)]);

?>