<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 29.05.14
 * Time: 18:55
 */

if (isset($_GET['logout'])) {
    $_SESSION = array();
    setcookie("PHPSESSID", "", time() - 3600, "/");
    session_destroy();
    session_start();
}