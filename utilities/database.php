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

    $query = "SELECT id FROM users WHERE email = ? AND hash = MD5(CONCAT(?, salt))";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "ss", $email, $password);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $id);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    // create session for login with id and pass the session_id

    return $id;
}

function get_menus()
{
    $connection = connect();

    $query = "SELECT name, picture, description, content FROM menus";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $name, $picture, $description, $content);

    while (mysqli_stmt_fetch($result)) {
        $menus[] = array(
            'name' => $name,
            'picture' => $picture,
            'description' => $description,
            'content' => $content
        );
    }

    mysqli_stmt_close($result);

    mysqli_close($connection);

    return $menus;
}

function get_contents()
{
    $connection = connect();

    $query = "SELECT id, title, picture, description, content FROM contents";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $id, $title, $picture, $description, $content);

    while (mysqli_stmt_fetch($result)) {
        $contents[] = array(
            'id' => $id,
            'title' => $title,
            'picture' => $picture,
            'description' => $description,
            'content' => $content
        );
    }

    mysqli_stmt_close($result);

    mysqli_close($connection);

    return $contents;
}

function delete_content($content)
{
    $connection = connect();

    $query = "DELETE FROM contents WHERE id = " . $content["id"];
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

    return $result ? "success" : "error";
}

function edit_content($content)
{
    $connection = connect();

    $query = "UPDATE contentes SET title = " . $content["title"] . ", picture = " . $content["picture"] . ", description = 'AUTOMATED_DESC_F', content = " . $content["content"] . " WHERE id = " . $content["id"];
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

    return $result ? "success" : "error";
}

?>