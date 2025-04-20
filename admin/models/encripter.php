<?php

function hash1($text){
    return hash('sha256', $text);
}

function base64ToText($text){
    return base64_decode($text);
}

function text2base64($text){
    return base64_encode($text);
}

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    header("Location: ../../");
    exit();
}
?>