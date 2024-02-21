<?php

require "./utilities/post.php";
require "./utilities/database.php";
require "./utilities/configuration.php";

$order = post();

$id = create_order_request($order["id"], $order["province"], $order["district"], $order["days"], $order["time"], $order["promotion"], $order["name"], $order["phone"], $order["email"], $order["address"], $order["height"], $order["weight"], $order["allergy"], $order["disease"], $order["occupation"], $order["extra"]);

if (!$id)
    echo json_encode(["status" => "error"]);
else {
    $price = calculate_price($order["id"], $order["promotion"], $order["days"]);
    $menu_name = get_menu_name($order["id"]);
    $hash = base64_encode(hash("sha512", ($id . $price . "TRY" . $menu_name . $order["name"] . $order["phone"] . $order["email"] . $order["address"] . PAYMES_SECRET_KEY)));

    $paymes = curl_init(PAYMES_URL);
    curl_setopt($paymes, CURLOPT_POST, 1);
    curl_setopt(
        $paymes,
        CURLOPT_POSTFIELDS,
        array(
            "publicKey" => PAYMES_PUBLIC_KEY,
            "orderId" => $id,
            "price" => $price,
            "currency" => "TRY",
            "productName" => $menu_name,
            "buyerName" => $order["name"],
            "buyerPhone" => $order["phone"],
            "buyerEmail" => $order["email"],
            "buyerAddress" => $order["address"],
            "hash" => $hash,
        )
    );
    curl_setopt($paymes, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($paymes);

    if (curl_errno($paymes))
        echo json_encode(["status" => "error"]);
    else
        echo json_encode(["status" => $result]);

    curl_close($paymes);
}