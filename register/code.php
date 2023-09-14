<?php

require "../utilities/post.php";
require "../utilities/database.php";

$code = post()["code"];

$code = register_code_check($code);

if ($code)
    echo json_encode(["status" => "success", "code" => $code]);
else
    echo json_encode(["status" => "code_invalid"]);

?>