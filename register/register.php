<?php

require "../utilities/post.php";
require "../utilities/database.php";

$mail = post()["email"];

if (email_check($mail)) {
    echo json_encode([true]);
} else {
    echo json_encode([false]);
}


?>