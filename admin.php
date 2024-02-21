<?php

require "./utilities/post.php";
require "./utilities/database.php";

$request = post();

if ($request["code"] != 139565)
    die(json_encode(["status" => "error"]));

switch ($request["action"]) {
    case "delete-content":
        echo json_encode(["status" => delete_content($request)]);
        break;
    case "edit-content":
        echo json_encode(["status" => edit_content($request)]);
        break;
    case "create-content":
        echo json_encode(["status" => create_content($request)]);
        break;
}