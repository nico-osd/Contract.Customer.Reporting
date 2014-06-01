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


/**
 * SERVER URL INFORMATION
 */
$base_dir  = __DIR__; // Absolute path to your installation, ex: /var/www/mywebsite
$doc_root  = preg_replace("!{$_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
$base_url  = preg_replace("!^{$doc_root}!", '', $base_dir); # ex: '' or '/mywebsite'
$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$port      = $_SERVER['SERVER_PORT'];
$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
$domain    = $_SERVER['SERVER_NAME'];
$full_url  = "$protocol://{$domain}{$disp_port}{$base_url}"; # Ex: 'http://example.com', 'https://example.com/mywebsite', etc.


/**
 * CONSTANTS (ähnlich wie public static final Variablen), Name immer in UPPER-CASE schreiben
 */
define("LIBS", "libs/");
define("CONTROLLERS", "controllers/");
define("ENTITIES", "entities/");
define("BOUNDARIES", "boundaries/");
define("INCS", "inc/");
define("URL", $full_url);


$host = 'wi-projectdb.technikum-wien.at';
$user = 'ss14-bvz2-fst-2';
$pass = 'DbPass4BVZ2-2';
$db_name = 'ss14-bvz2-fst-2';

// ini_set('display_errors', 0);

// alternatives:
$alt_host = '127.0.0.1';

$mysqli = new mysqli($host, $user, $pass, $db_name);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

    $mysqli = new mysqli($alt_host, $user, $pass, $db_name, 3306);

    if ($mysqli->connect_errno)
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}