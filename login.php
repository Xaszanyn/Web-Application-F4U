<?php

require "./utilities/post.php";
require "./utilities/database.php";

$login = post();

echo json_encode(login_user($login["email"], $login["password"]));

?>