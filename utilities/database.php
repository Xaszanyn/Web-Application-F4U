<?php

require "configuration.php";

function connect()
{
    $connection = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE);

    mysqli_set_charset($connection, "UTF8");

    if (mysqli_connect_errno() > 0)
        die("Hata");

    return $connection;
}

function register_email_control($email)
{
    $connection = connect();

    $query = "SELECT EXISTS(SELECT * FROM users WHERE email = ?)";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "s", $email);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $exists);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    return !$exists;
}

// function register_email_check($email)
// {
//     $connection = connect();

//     $query = "SELECT EXISTS(SELECT * FROM users WHERE email = ?)";
//     $result = mysqli_prepare($connection, $query);
//     mysqli_stmt_bind_param($result, "s", $email);
//     mysqli_stmt_execute($result);
//     mysqli_stmt_bind_result($result, $exists);
//     mysqli_stmt_fetch($result);
//     mysqli_stmt_close($result);

//     if (!$exists) {
//         $query = "INSERT INTO registries(email, code, time) VALUES (?, ?, ?)";
//         $result = mysqli_prepare($connection, $query);
//         $time = time();
//         $code = mt_rand(10000, 99999);
//         mysqli_stmt_bind_param($result, "sii", $email, $code, $time);
//         mysqli_stmt_execute($result);
//         mysqli_stmt_close($result);
//     }

//     mysqli_close($connection);

//     return !$exists;
// }

function register_code_check($code)
{
    $connection = connect();

    $query = "SELECT email, code FROM registries WHERE code = ?";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "i", $code);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $email, $code);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    $query = "DELETE FROM registries WHERE code = ?";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "i", $code);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);

    if ($email) {
        $query = "INSERT INTO registry_controls(email, code, time) VALUES (?, ?, ?)";
        $result = mysqli_prepare($connection, $query);
        $time = time();
        mysqli_stmt_bind_param($result, "sii", $email, $code, $time);
        mysqli_stmt_execute($result);
        mysqli_stmt_close($result);

        return $code;
    } else
        return false;
}

?>