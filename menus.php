<?php

require "./utilities/database.php";

if ($_SERVER["REQUEST_METHOD"] != "GET")
    die("Hata");


$menus = get_menus();

print_r($menus);



?>