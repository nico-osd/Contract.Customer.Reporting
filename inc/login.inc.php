<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 29.05.14
 * Time: 18:50
 */

if (isset($_POST['login'])) {
    include('controll/LoginController.class.php');

    $username = htmlspecialchars($mysqli->escape_string($_POST['username']));
    $password = htmlspecialchars($_POST['password']);

    $login = new controller\LoginControll($mysqli);

    $success = $login->checkLogin($username, $password);

    if ($success)
        $login->setSessionDetails($username);
}