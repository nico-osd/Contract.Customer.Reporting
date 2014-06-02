<?php
session_start();
use CCR\libs\Session;

require "config.php";

/**
 * Funktion um automatisch alle Klassen von den angegeben Pfaden zu laden
 *
 * @param string $class Name der Datei die geladet werden soll
 */
function autoload_class_multiple_directory($class)
{
    // Class directorys
    $paths = array(
        LIBS,
        ENTITIES,
        CONTROLLERS

    );

    // Used for namespaces
    $parts = explode('\\', $class);
    $class = end($parts);

    foreach ($paths as $path) {
        $file = sprintf("%s%s.class.php", $path, $class);

        if (is_file($file)) {
            require $file;
        }
    }
}

//Führt Funktion "autoload_class_multiple_directory" aus, ausgeführt wenn seite geladen wird
spl_autoload_register('autoload_class_multiple_directory');


//Ladet automatisch alle Dateien vom Ordner inc/
foreach (glob(INCS . "*.inc.php") as $filename) {
    require $filename;
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Felix Martin Hi-Fi und Videostudios</title>

    <link rel="stylesheet" type="text/css" href="public/css/normalize.css"/>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/form.css">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="public/js/javascript.js"></script>
</head>
<body>

<div id="site"> <!-- GANZE SEITE INKLUSIVE WRAPPER UND FOOTER -->
    <div id='wrapper'> <!-- HEADER + CONTENT -->

        <!-- HEADER -->
        <header id="header">
            <!-- BREADCRUMB -->
            <div id="breadcrumb" class="clear">
                <h1>
                    <a href="<?php echo URL; ?>">CCR</a>
                    <?php
                    if (Session::get("site")) {
                        for ($i = 0; $i < count($_SESSION['site']); $i++) {
                            echo ' | <a href="index.php?section=' . $_SESSION['site'][$i] . '">' . $_SESSION['site'][$i] . '</a>';
                        }
                    }
                    ?>
                </h1>
            </div>

            <!-- USER INFO, FALLS EINGELOGGT -->
            <?php if (Session::get("username")) : ?>
                <div id="userinfo">
                    <p>Eingeloggt
                        als: <?php echo Session::get("vorname") . " " . Session::get("nachname") . ", Abteilung: " . Session::get("rolle"); ?></p>

                    <p><a href="index.php?logout">Logout</a></p>
                </div>
            <?php endif; ?>


        </header>

        <!-- CONTENT -->
        <div id="content">
            <?php

            if (isset($_GET['section'])) {
                if (!Session::get("username")) {
                    require BOUNDARIES . "login/login.php";
                } else {
                    //Hier werden die verschiedenen sections eingetragen == verschiedene HTML Seiten
                    switch ($_GET['section']) {
                        case "dashboard":
                            require BOUNDARIES . "dashboard/dashboard.php";
                            break;

                        /* INCLUDES VON AUFTRAGSMANAGEMENT */
                        case "artikel":
                            require BOUNDARIES . "article/article.php";
                            break;

                        /* INCLUDES VON KUNDENBEZIEHUNGSMANAGEMENT */
                        case "kundeanlegen":
                            require BOUNDARIES . "customer/newCustomer.php";
                            break;

                        /* INCLUDES VON BERICHTSWESEN */
                        case 'Personalreporting':
                            include('Berichtswesen/Personalreporting.php');
                            break;

                        /* DEFAULT */
                        default:
                            include(BOUNDARIES . "dashboard/dashboard.php");
                            break;
                    }
                }
            } else {
                if (Session::get("username")) {
                    require BOUNDARIES . "dashboard/dashboard.php";
                } else {
                    require BOUNDARIES . "login/login.php";
                }
            }
            ?>
        </div>
        <!-- end of content -->
    </div>
    <!-- end of wrapper -->

    <!-- FOOTER, AUßERHALB VOM DIV "WRAPPER" -> FOOTER BLEIBT GANZ UNTEN  -->
    <div id="footer">
        <div id="footer-content">
            <a href="fpdf17/FAQ.htm">FAQ | Impressum</a>
        </div>
    </div>
</div>
<!-- end of site -->
</body>
</html>
