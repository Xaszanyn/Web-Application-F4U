<?php

session_start();

echo ini_get("session.gc_maxlifetime") . "<hr>";

echo "<pre>";
print_r($_SESSION);





?>