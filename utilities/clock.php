<?php

require "database.php";

$connection = connect();

$query = "DELETE FROM registries WHERE time >= " . (time() - 300);

$result = mysqli_query($connection, $query);

mysqli_close($connection);

?>