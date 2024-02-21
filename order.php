<?php

require "./utilities/post.php";
require "./utilities/configuration.php";

$order = post();

$id = create_order_request($order["id"], $order["province"], $order["district"], $order["days"], $order["time"], $order["promotion"], $order["name"], $order["phone"], $order["email"], $order["address"], $order["height"], $order["weight"], $order["allergy"], $order["disease"], $order["occupation"], $order["extra"]);

if (!$id)
    echo json_encode(["status" => "error"]);
else {
    $price = calculate_price($order["id"], $order["promotion"], $order["days"]);
}




// $productName = "Menü İsmi";



// $str = $id . $price . "TRY" . $productName . $order["name"] . $order["phone"] . $order["email"] . $order["address"] . PAYMES_SECRET_KEY;

// $hashed = hash("sha512", $str);

// $encoded = base64_encode($hashed);





// $postData = array(
//     "publicKey" => PAYMES_PUBLIC_KEY,
//     "orderId" => $id,
//     "price" => $price,
//     "currency" => "TRY",
//     "productName" => $productName,
//     "buyerName" => $order["name"],
//     "buyerPhone" => $order["phone"],
//     "buyerEmail" => $order["email"],
//     "buyerAddress" => $order["address"],
//     "hash" => $encoded,
// );


// $ch = curl_init(PAYMES_URL);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


// $result = curl_exec($ch);


// if (curl_errno($ch)) {
//     echo 'Curl error: ' . curl_error($ch);
// }


// curl_close($ch);

// echo "<br><br><br>";
// echo $result;

?>