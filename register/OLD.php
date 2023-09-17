<?php

require "../utilities/post.php";
require "../utilities/database.php";

$email = post()["email"];






if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if (register_email_check($email)) {

        session_start();

        $_SESSION["email"] = $email;
        $_SESSION["code"] = mt_rand(10000, 99999);

        echo json_encode(["status" => "success", "NOTFROMHERE" => $_SESSION["code"]]);
    } else {
        echo json_encode(["status" => "email_used"]);
    }
} else
    echo json_encode(["status" => "email_invalid"]);

?>