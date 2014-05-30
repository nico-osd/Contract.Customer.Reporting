<?php
session_start();

/**
 * Erstellt eine Datenverbindung in der Variable $mysqli
 */
include('inc/config/config.php');

/**
 * Falls $_GET['logout'] gesetzt ist,
 * wird der Benutzer ausgeloggt.
 * Das bedeutet:
 * - die Session geloescht
 * - Das Cookie geloescht
 */
include('inc/logout.inc.php');

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Felix Martin HIFI und Videostudios</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
</head>
<body>
<div id='wrapper'>
    <?php

    /**
     * ueberprueft ob die gegebenen Anmeldedaten
     * und setzt die Anmeldeinformationen
     * (falls die Anmeldung erfolgreich war)
     * ins $_SESSION Array:
     *
     * $_SESSION['username']
     * $_SESSION['nachname']
     * $_SESSION['vorname']
     * $_SESSION['rolle']
     * $_SESSION['telefonnummer']
     * $_SESSION['id']
     **/
    include('inc/login.inc.php');
    ?>

    <header id="header"></header>
    <div id="content">
        <?php

        if (!isset($_SESSION['username'])) {
            include('login.php');
        } else {
            if (isset($_GET['section'])) {
                switch ($_GET['section']) {
                    case 'login':
                        include('login.php');
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

                    case 'dashboard':
                        include('dashboard.php');
                        break;

                    default:
                        include('dashboard.php');
                        break;
                }
            } else {
                include('dashboard.php');
            }
        }

        ?>
    </div>
    <div id="headeroverlay">
        <div id="breadcrumb" class="clear">
            <h1>
                <a href="index.php">CCR</a>
                <?php
                if (isset($_SESSION['site'])) {
                    for ($i = 0; $i < count($_SESSION['site']); $i++) {
                        echo ' | <a href="index.php?section=' . $_SESSION['site'][$i] . '">' . $_SESSION['site'][$i] . '</a>';
                    }
                }
                ?>
            </h1>
        </div>
        <?php

        if (isset($_SESSION['username'])) {
            echo '<div id="userinfo"><a href="index.php?logout">Eingeloggt als ' . $_SESSION['rolle'] . ' ' . $_SESSION['vorname'] . ' ' . $_SESSION['nachname'] . '</a></div>';
        }
        ?>
    </div>
</div>
</body>
</html>
