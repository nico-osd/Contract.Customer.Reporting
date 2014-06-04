<?php
//Für Breadcrumb
use CCR\libs\Cookie;
Cookie::setBreadcrumbCookie(array("dashboard", "Artikel"));
?>

<div>
    <ul>
        <li><a href="index.php?section=Artikel anlegen">Artikel anlegen</a></li>
        <li><a href="index.php?section=Artikel suchen">Artikel suchen</a></li>
        <li><a href="index.php?section=Artikel ändern">Artikel ändern</a></li>
        <li><a href="index.php?section=Artikel löschen">Artikel löschen</a></li>
    </ul>

</div>