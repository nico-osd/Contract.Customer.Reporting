<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 29.05.14
 * Time: 18:55
 */

use CCR\libs\Session;

if (isset($_GET['logout'])) {
    Session::destroy();
    header("Location: index.php");
}