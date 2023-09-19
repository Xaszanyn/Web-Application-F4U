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

function register_user($name, $phone, $address, $password)
{
    $connection = connect();

    $query = "INSERT INTO users(email, name, phone, address, picture, salt, hash) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connection, $query);
    $picture = "-";
    $salt = bin2hex(random_bytes(16));
    $hash = md5($password . $salt);
    mysqli_stmt_bind_param($result, "sssssss", $_SESSION["email"], $name, $phone, $address, $picture, $salt, $hash);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);
}

function login_user($email, $password)
{
    $connection = connect();

    $query = "SELECT * FROM users WHERE email = ? AND MD5(CONCAT(?, salt))";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "ss", $email, $password);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $user);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    return $user;
}

?>