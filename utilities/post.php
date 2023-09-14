<?php

function post()
{
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header('Content-Type: application/json');

    if ($_SERVER["REQUEST_METHOD"] != "POST")
        die("Hata");

    return json_decode(file_get_contents("php://input"), true);
}

?>