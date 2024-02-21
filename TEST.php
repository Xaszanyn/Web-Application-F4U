<?php

require "./utilities/database.php";

echo get_menu_name(1);


// $publicKey = "9291d957-8df4-47b0-9ae5-b618da00ae29";


// $orderId = "1";
// $price = "1";
// $currency = "TRY";
// $productName = "Ürün İsmi";
// $buyerName = "Ekin Aslan";
// $buyerPhone = "05555555555";
// $buyerEmail = "ekinaslant@gmail.com";
// $buyerAddress = "Örnek adres bilgisi";
// $secretKey = "7b4745d21d8e89ccbc5c7619f2e01cd6";

// $str = $orderId . $price . $currency . $productName . $buyerName . $buyerPhone . $buyerEmail . $buyerAddress . $secretKey;

// $hashed = hash("sha512", $str);

// $encoded = base64_encode($hashed);



// echo $str . "<br>";
// echo $hashed . "<br>";
// echo $encoded . "<br>";


// echo "<br><br><br>";


// $url = 'https://api.paym.es/v4.6/order_create';


// $postData = array(
//     "publicKey" => $publicKey,
//     "orderId" => $orderId,
//     "price" => $price,
//     "currency" => $currency,
//     "productName" => $productName,
//     "buyerName" => $buyerName,
//     "buyerPhone" => $buyerPhone,
//     "buyerEmail" => $buyerEmail,
//     "buyerAddress" => $buyerAddress,
//     "hash" => $encoded,
// );


// $ch = curl_init($url);
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