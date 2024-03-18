<?php

require "configuration.php";

function connect()
{
    $connection = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE);

    mysqli_set_charset($connection, "UTF8");

    if (mysqli_connect_errno() > 0)
        die ("Hata");

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

    $query = "SELECT id, email, name, phone, address, picture FROM users WHERE email = ? AND hash = MD5(CONCAT(?, salt))";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "ss", $email, $password);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $id, $email, $name, $phone, $address, $picture);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    if (!empty ($id)) {
        return ["email" => $email, "name" => $name, "phone" => $phone, "address" => $address, "picture" => $picture];
    }
}

function get_menus()
{
    $connection = connect();

    $query = "SELECT id, name, picture, description, content, price, discount FROM menus";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $id, $name, $picture, $description, $content, $price, $discount);

    while (mysqli_stmt_fetch($result)) {
        $menus[] = array(
            'id' => $id,
            'name' => $name,
            'picture' => $picture,
            'description' => $description,
            'content' => $content,
            'price' => $price,
            'discount' => $discount
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

function get_locations()
{
    $connection = connect();

    $query = "SELECT id, name FROM provinces";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $id, $name);
    while (mysqli_stmt_fetch($result)) {
        $provinces[] = array(
            'id' => $id,
            'name' => $name,
        );
    }
    mysqli_stmt_close($result);

    $query = "SELECT id, name, province_id FROM districts";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $id, $name, $province_id);
    while (mysqli_stmt_fetch($result)) {
        $districts[] = array(
            'id' => $id,
            'name' => $name,
            'province_id' => $province_id
        );
    }
    mysqli_stmt_close($result);

    mysqli_close($connection);

    return ['provinces' => $provinces, 'districts' => $districts];
}

function promotion_control($code)
{
    $connection = connect();

    $query = "SELECT EXISTS(SELECT * FROM promotions WHERE code = ?)";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "s", $code);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $exists);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    return $exists;
}

function calculate_price($id, $promotion, $days)
{
    $connection = connect();

    $query = "SELECT price, discount FROM menus WHERE id = ?";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "s", $id);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $original, $discount);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    $query = "SELECT discount FROM promotions WHERE code = ?";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "s", $promotion);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $promotion_discount);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    if (empty ($original)) {
        return ["status" => "error"];
    }

    $price = ceil(empty ($promotion_discount) ? $original * ((100 - $discount) / 100) : $original * ((100 - ($discount + $promotion_discount)) / 100)) * $days;

    return ["status" => "success", "original" => $original * $days, "price" => $price];

}

function create_order_request($menu_id, $province_id, $district_id, $days, $time, $promotion, $name, $phone, $email, $address, $gender, $height, $weight, $allergy, $disease, $occupation, $extra)
{
    if (!in_array($days, [5, 10, 20, 60]))
        return 0;

    $connection = connect();

    $query = "INSERT INTO order_requests(menu_id, date, province_id, district_id, days, time, promotion, name, phone, email, address, gender, height, weight, allergy, disease, occupation, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connection, $query);
    date_default_timezone_set("Europe/Istanbul");
    $date = date('Y-m-d H:i:s');
    $allergy = empty ($allergy) ? "-" : $allergy;
    $disease = empty ($disease) ? "-" : $disease;
    $occupation = empty ($occupation) ? "-" : $occupation;
    $extra = empty ($extra) ? "-" : $extra;
    mysqli_stmt_bind_param($result, "ssssssssssssssssss", $menu_id, $date, $province_id, $district_id, $days, $time, $promotion, $name, $phone, $email, $address, $gender, $height, $weight, $allergy, $disease, $occupation, $extra);
    mysqli_stmt_execute($result);
    $id = mysqli_insert_id($connection);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    return $id;
}

function create_company_order_request($menu_id, $province_id, $district_id, $days, $time, $promotion, $name, $phone, $email, $address, $allergy, $disease, $extra, $tax_number, $company_name, $tax_administration, $tax_method, $company_address)
{
    if (!in_array($days, [5, 10, 20, 60]))
        return 0;

    $connection = connect();

    $query = "INSERT INTO company_order_requests(menu_id, date, province_id, district_id, days, time, promotion, name, phone, email, address, allergy, disease, extra, tax_number, company_name, tax_administration, tax_method, company_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connection, $query);
    date_default_timezone_set("Europe/Istanbul");
    $date = date('Y-m-d H:i:s');
    $allergy = empty ($allergy) ? "-" : $allergy;
    $disease = empty ($disease) ? "-" : $disease;
    $occupation = empty ($occupation) ? "-" : $occupation;
    $extra = empty ($extra) ? "-" : $extra;
    mysqli_stmt_bind_param($result, "sssssssssssssssssss", $menu_id, $date, $province_id, $district_id, $days, $time, $promotion, $name, $phone, $email, $address, $allergy, $disease, $extra, $tax_number, $company_name, $tax_administration, $tax_method, $company_address);
    mysqli_stmt_execute($result);
    $id = mysqli_insert_id($connection);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    return $id;
}

function get_menu_name($id)
{
    $connection = connect();

    $query = "SELECT name FROM menus WHERE id = ?";
    $result = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($result, "s", $id);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $name);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    return $name;
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

    $query = "UPDATE contents SET title = '" . $content["title"] . "', picture = '" . $content["picture"] . "', description = 'AUTOMATED_DESC_F', content = '" . $content["content"] . "' WHERE id = " . $content["id"];
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

    return $result ? "success" : "error";
}

function create_content($content)
{
    $connection = connect();

    $query = "INSERT INTO contents(title, picture, description, content) VALUES (?, ?, ?, ?)";
    $result = mysqli_prepare($connection, $query);
    $description = 'AUTOMATED_DESC_F';
    $picture = "UNASSIGNED_P";
    mysqli_stmt_bind_param($result, "ssss", $content["title"], $picture, $description, $content["content"]);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);

    mysqli_close($connection);

    return $result ? "success" : "error";
}