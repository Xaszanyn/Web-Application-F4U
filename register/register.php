<?php

require "../utilities/post.php";
require "../utilities/database.php";

$mail = post()["email"];




echo json_encode(test());

?>