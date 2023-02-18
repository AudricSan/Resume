<?php

if (!isset($_SESSION['logged'])) {
    header('location: /settings/login');
    die;

} else {
    $adminDAO = new AdminDAO;
    $adminConnected = $adminDAO->validate($_SESSION['logged'], $_SESSION['uuid']);
    if (!$adminConnected) {
        unset($_SESSION['logged']);
        header('location: /');
        die;
    }
}