<?php

require "../utilities/database.php";

$connection = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE);

mysqli_set_charset($connection, "UTF8");

if (mysqli_connect_errno() == 0) {

    $query = "DELETE FROM registries WHERE time >= " . (time() - 300);

    $result = mysqli_query($connection, $query);

}

mysqli_close($connection);

?>