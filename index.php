<?php

session_start();

require "config.php";

/**
 * Funktion um automatisch alle Klassen von den angegeben Pfaden zu laden
 *
 * @param string $class Name der Datei die geladet werden soll
 */
function autoload_class_multiple_directory($class) {
    // Class directorys
    $paths = array(
        LIBS,
        ENTITIES,
        CONTROLLERS

    );

    // Used for namespaces
    $parts = explode('\\', $class);
    $class =  end($parts);

    foreach($paths as $path) {
        $file = sprintf("%s%s.class.php", $path, $class);

        if(is_file($file)) {
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
            <title>Felix Martin HIFI und Videostudios</title>
            <link rel="stylesheet" type="text/css" href="public/css/normalize.css"/>
            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
            <link rel="stylesheet" type="text/css" href="public/css/main.css"/>
            <link rel="stylesheet" type="text/css" href="public/css/form.css">
            <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
            <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script type="text/javascript" src="public/js/javascript.js"></script>
        </head>
    <body>
        <div id='wrapper'>


        <header id="header"></header>
        <div id="content">
            <?php

            if(!Session::get("username")) {
                include(BOUNDARIES . "login/login.php");
            }
            else {
                if(isset($_GET['section'])) {
                    switch ($_GET['section']) {
                        case 'login':
                            include(BOUNDARIES . "login/login.php");
                            break;

                        case 'artikel':
                            include('artikel.php');
                            break;

                        case 'angebote':
                            include('angebote.php');
                            break;

                        case 'auftraege':
                            include('auftraege.php');
                            break;

                        case 'rechnungen':
                            include('rechnungen.php');
                            break;

                        case 'kunde':
                            include('kunde.php');
                            break;

                        case 'USt':
                            include('USt.php');
                            break;

                        case 'kundenanfrage':
                            include('kundenanfrage.php');
                            break;

                        case 'feedback':
                            include('feedback.php');
                            break;
                        case 'Personalreporting':
                            include('Berichtswesen/Personalreporting.php');
                            break;

                        case 'dashboard':
                            include(BOUNDARIES . "dashboard/dashboard.php");
                            break;

                        default:
                            include(BOUNDARIES . "dashboard/dashboard.php");
                            break;
                    }
                }
                else {
                    include(BOUNDARIES . "dashboard/dashboard.php");
                }
            }

            ?>
        </div>


        <div id="headeroverlay">
            <div id="breadcrumb" class="clear">
                <h1>
                    <a href="index.php">CCR</a>
                    <?php
                    if (Session::get("site")) {
                        for ($i = 0; $i < count($_SESSION['site']); $i++) {
                            echo ' | <a href="index.php?section=' . $_SESSION['site'][$i] . '">' . $_SESSION['site'][$i] . '</a>';
                        }
                    }
                    ?>
                </h1>
            </div>
            <?php

            if (Session::get("username")) {
                echo '<div id="userinfo"><a href="index.php?logout">Eingeloggt als ' . $_SESSION['rolle'] . ' ' . $_SESSION['vorname'] . ' ' . $_SESSION['nachname'] . '</a></div>';
            }

            if(isset($_GET['logout'])) {
                header("Location: index.php");
            }

            ?>
        </div>
    </div>
    </body>
</html>
