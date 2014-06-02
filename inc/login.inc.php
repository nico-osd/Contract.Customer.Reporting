<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 29.05.14
 * Time: 18:50
 */

use CCR\controllers\LoginController;

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $login = new LoginController();

    $result = $login->checkLogin($username, $password);

    if(!$result) {
        $loginErrors = "Username/Passwort ist falsch!";
    }
    else {
        header("Location: index.php?section=dashboard");
    }

}