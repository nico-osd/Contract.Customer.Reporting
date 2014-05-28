<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11.01.14
 * Time: 12:15
 * Server: wi-projectdb.technikum-wien.at
 * Port: 3306
 * Databasename: ss14-bvz2-fst-2
 * User: ss14-bvz2-fst-2
 * PW: DbPass4BVZ2-2
 *
 */
$host = 'wi-projectdb.technikum-wien.at';
$user = 'ss14-bvz2-fst-2';
$pass = 'DbPass4BVZ2-2';
$db_name = 'ss14-bvz2-fst-2';

// ini_set('display_errors', 0);

// alternatives:

$alt_host = '127.0.0.1';

$con = new mysqli($host, $user, $pass, $db_name);

if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;

    $con = new mysqli($alt_host, $user, $pass, $db_name, 3306);

    if ($con->connect_errno)
        echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}