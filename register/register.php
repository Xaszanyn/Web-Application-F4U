<?php

require "../utilities/post.php";
require "../utilities/database.php";

$email = post()["email"];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if (email_check($email)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "email_used"]);
    }
} else
    echo json_encode(["status" => "email_invalid"]);

?>