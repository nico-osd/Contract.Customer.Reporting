<?php

    $con = mysql_connect("localhost", "root", "hoppel");
    mysql_select_db("mydb") or mysql_query("CREATE DATABASE mydb");  ;



    session_start();

    if (isset($_GET['logout'])) {
        $_SESSION = array();
        setcookie ("PHPSESSID", "", time() - 3600, "/");
        session_destroy();
        session_start();
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Felix Martin HIFI und Videostudios</title>
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="stylesheet" type="text/css" href="css/form.css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script type="text/javascript" src="js/javascript.js"></script>
    </head>
    <body>
        <div id='wrapper'>
            <header id="header"></header>
            <div id="content">
             <?php

                if (isset($_POST['login'])) {
                    $username = htmlspecialchars(mysql_real_escape_string($_POST['username'])); 
                    $password = htmlspecialchars($_POST['password']);

                    checkLogin ($username, $password);
                }

                function checkLogin ($username, $password) {
                    $result = mysql_query("select * from Mitarbeiter where Username='" . $username . "' and Passwort='" .$password. "'");
                    
                    if (mysql_num_rows($result) > 0) {
                        $row = mysql_fetch_assoc($result);
                        $_SESSION['username'] = $username;
                        $_SESSION['vorname'] = $row['Vorname'];
                        $_SESSION['nachname'] = $row['Nachname'];
                        $_SESSION['rolle'] = $row['Rolle'];
                        $_SESSION['id'] = $row['ID'];
                    } else {
                        echo '<div class="error">Username oder Passwort falsch!</div>';
                    }
                }

                if (!isset($_SESSION['username'])) {
                    include('login.php');
                } else {
                    if (isset($_GET['section'])) {
                        switch ($_GET['section']) {
                            case 'login':
                                include('login.php');
                                break;

                            case 'artikel':
                                include ('artikel.php');
                                break;

                            case 'angebote':
                                include ('angebote.php');
                                break;

                            case 'auftraege':
                                include ('auftraege.php');
                                break;

                            case 'rechnungen':
                                include('rechnungen.php');
                                break;

                            case 'kunde':
                                include ('kunde.php');
                                break;

                            case 'USt':
                                include('USt.php');
                                break;

                            case 'kundenanfrage':
                                include ('kundenanfrage.php');
                                break;

                            case 'feedback':
                                include ('feedback.php');
                                break;

                            case 'dashboard':
                                include ('dashboard.php');
                                break;
                            
                            default:
                                include ('dashboard.php');
                                break;
                        }
						}else {
                        include ('dashboard.php');
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
                                for ($i=0; $i < count($_SESSION['site']); $i++) { 
                                    echo ' | <a href="index.php?section=' . $_SESSION['site'][$i] . '">' . $_SESSION['site'][$i] . '</a>';
                                }
                            }
                        ?>
                    </h1>
                </div>
                <?php
                  
                    if (isset($_SESSION['username'])) {
                        echo '<div id="userinfo"><a href="index.php?logout">Eingeloggt als ' .$_SESSION['rolle']. ' ' . $_SESSION['vorname'] . ' ' . $_SESSION['nachname'] . '</a></div>';
						
						
                    }
                ?>
            </div>
        </div>
    </body>
</html>
