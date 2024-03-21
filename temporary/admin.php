<?php

require "./utilities/post.php";
require "./utilities/database.php";

$request = post();

if ($request["code"] != 139565)
    die (json_encode(["status" => "error"]));

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

// function delete_content($content)
// {
//     $connection = connect();

//     $query = "DELETE FROM contents WHERE id = " . $content["id"];
//     $result = mysqli_query($connection, $query);

//     mysqli_close($connection);

//     return $result ? "success" : "error";
// }

// function edit_content($content)
// {
//     $connection = connect();

//     $query = "UPDATE contents SET title = '" . $content["title"] . "', picture = '" . $content["picture"] . "', description = 'AUTOMATED_DESC_F', content = '" . $content["content"] . "' WHERE id = " . $content["id"];
//     $result = mysqli_query($connection, $query);

//     mysqli_close($connection);

//     return $result ? "success" : "error";
// }

// function create_content($content)
// {
//     $connection = connect();

//     $query = "INSERT INTO contents(title, picture, description, content) VALUES (?, ?, ?, ?)";
//     $result = mysqli_prepare($connection, $query);
//     $description = 'AUTOMATED_DESC_F';
//     $picture = "UNASSIGNED_P";
//     mysqli_stmt_bind_param($result, "ssss", $content["title"], $picture, $description, $content["content"]);
//     mysqli_stmt_execute($result);
//     mysqli_stmt_close($result);

//     mysqli_close($connection);

//     return $result ? "success" : "error";
// }