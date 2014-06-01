<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 29.05.14
 * Time: 18:50
 */

if (isset($_POST['login'])) {
    $username = htmlspecialchars($mysqli->escape_string($_POST['username']));
    $password = htmlspecialchars($_POST['password']);

    $login = new \controllers\LoginController($mysqli);

    $success = $login->checkLogin($username, $password);

    if($success)
        $login->setSessionDetails($username);
}