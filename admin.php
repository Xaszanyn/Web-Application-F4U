<?php

require "./utilities/post.php";
require "./utilities/database.php";

$request = post();

if ($request["code"] != 139565)
    die(json_encode(["status" => "error"]));


// action: "create-content", "edit-content"


switch ($request["action"]) {
    case "delete-content":
        echo json_encode(["status" => delete_content($request)]);
        break;

}


// echo json_encode(["temp_id" => login_user($login["email"], $login["password"]), "status" => "success"]);



?>