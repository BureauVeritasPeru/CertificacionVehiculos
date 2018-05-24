<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$sessionName = md5($_SERVER['SERVER_NAME']);
$cf = OWASP::RequestString('cf');

if (empty($_SESSION[$sessionName]) || strtolower(trim($cf)) != $_SESSION[$sessionName]){
    echo "Captcha incorrecto";
}
?>