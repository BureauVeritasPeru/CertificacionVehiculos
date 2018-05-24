<?php
if (!AdmLogin::isLogged()){
    header('location: '.$URL_ADMIN);
    exit();
}
?>