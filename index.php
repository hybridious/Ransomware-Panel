<?php 

require_once "config.php";

//get path to decrypt exe and feed the file to the client
//this functions the same as the default action in the java spring controller

$decryptexe_contents = file_get_contents($config_decryptexe_filepath);

set_time_limit(0);

header('Content-Type: Application/octet-stream');
header('Content-disposition: attachment;filename=' . $config_decryptexe_filename);
header('Content-Length: ' . strlen($decryptexe_contents)); // provide file size
header('Connection: close');

ob_clean();
flush();

print $decryptexe_contents;