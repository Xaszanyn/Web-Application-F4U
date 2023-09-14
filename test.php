<?php

require "./utilities/database.php";

$m = register_code_check(12345);



if ($m)
    echo $m;
else
    echo "can't found '_'";


?>