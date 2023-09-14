<?php

require "../utilities/post.php";
require "../utilities/database.php";

$mail = post()["email"];

if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    if (email_check($mail)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "email_used"]);
    }
} else
    echo json_encode(["status" => "email_invalid"]);

?>