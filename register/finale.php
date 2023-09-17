<?php

require "../utilities/post.php";
require "../utilities/database.php";

$registry = post();

switch ($registry["phase"]) {
    case "register":
        register($registry["email"]);
        break;
    case "confirm":
        confirm();
        break;
    case "create":
        create();
        break;
}


function register($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (register_email_control($email)) {
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["code"] = mt_rand(10000, 99999);
            echo json_encode(["status" => "success", "NOTFROMHERE" => $_SESSION["code"]]);
        } else
            echo json_encode(["status" => "email_used"]);
    } else
        echo json_encode(["status" => "email_invalid"]);
}

function confirm()
{
    echo json_encode(["status" => "nope"]);
}

function create()
{
    echo json_encode(["status" => "nope"]);
}








?>