<?php

require "configuration.php";

function email_check($email)
{
    $connection = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE);

    mysqli_set_charset($connection, "UTF8");

    if (mysqli_connect_errno() > 0)
        return "Hata";

    $query = "SELECT * FROM users";

    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_row($result)) {
        if ($email == $row[1]) {
            mysqli_close($connection);
            return false;
        }

    }

    mysqli_close($connection);
    return true;
}


?>