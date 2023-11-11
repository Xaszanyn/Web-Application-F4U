<?php

require "./utilities/post.php";
require "./utilities/database.php";

$login = post();

echo json_encode(["temp_id" => login_user($login["email"], $login["password"]), "status" => "success"]);

?>