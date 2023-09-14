<?php

require "configuration.php";

function test()
{

    $connection = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE);

    mysqli_set_charset($connection, "UTF8");

    if (mysqli_connect_errno() > 0)
        return "Hata";




    $query = "SELECT * FROM users";


    $result = mysqli_query($connection, $query);

    $list = [];

    while ($row = mysqli_fetch_row($result)) {
        $list[] = $row;
    }

    mysqli_close($connection);

    return $list;
}



?>