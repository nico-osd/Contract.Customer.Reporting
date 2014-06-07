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

define("DB_TYPE", "mysql");
define("DB_HOST", "wi-projectdb.technikum-wien.at");
define("DB_NAME", "ss14-bvz2-fst-2");
define("DB_USER", "ss14-bvz2-fst-2");
define("DB_PASS", "DbPass4BVZ2-2");


$host = 'wi-projectdb.technikum-wien.at';
$user = 'ss14-bvz2-fst-2';
$pass = 'DbPass4BVZ2-2';
$db_name = 'ss14-bvz2-fst-2';