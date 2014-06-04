<?php
//Für Breadcrumb
use CCR\libs\Cookie;
Cookie::setBreadcrumbCookie(array("dashboard"));
?>

<div id="dashboard">

    <!-- AUFTRAGSMANAGEMENT -->
    <h2>Auftragsmanagement</h2>

    <div class="row">
        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=Artikel">
                    <img src="public/images/icons/artikel.jpg" alt="Artikel">
                    <figcaption>Artikel verwalten</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=Lieferantenkonditionen">
                    <img src="public/images/icons/angebot.jpg" alt="Lieferantenkonditionen">
                    <figcaption>Lieferantenkonditionen verwalten</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=Kundenangebote">
                    <img src="public/images/icons/angebot.jpg" alt="Kundenangebote">
                    <figcaption>Kundenangebote verwalten</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=Angebotsstatus">
                    <img src="public/images/icons/angebot.jpg" alt="Angebotsstatus">
                    <figcaption>Angebotsstatus ändern</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=Kundenaufträge">
                    <img src="public/images/icons/auftrag.jpg" alt="Kundenaufträge">
                    <figcaption>Kundenaufträge abrufen</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=Kundenrechnungen">
                    <img src="public/images/icons/rechnung.jpg" alt="Kundenrechnungen">
                    <figcaption>Kundenrechnungen abrufen</figcaption>
                </a>
            </figure>
        </div>
    </div>

    <hr>

    <!-- KUNDENBEZIEHUNGSMANAGEMENT -->
    <h2>Kundenbeziehungsmanagement</h2>

    <div class="row">
        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=<?php echo htmlspecialchars("Kunde anlegen"); ?>">
                    <img src="public/images/icons/kundeanlegen.png" alt="Kunde anlegen">
                    <figcaption>Kunde anlegen</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=kundengruppe">
                    <img src="public/images/icons/kundengruppe.png" alt="Kundengruppen">
                    <figcaption>Kundengruppen</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=kundenanfragen">
                    <img src="public/images/icons/kundenanfragen.png" alt="Kundenanfragen">
                    <figcaption>Anfrage aufnehmen</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=feedback">
                    <img src="public/images/icons/feedback.png" alt="Feedback">
                    <figcaption>Kunden Feedback</figcaption>
                </a>
            </figure>
        </div>
    </div>

    <!-- zweite Reihe -->
    <div class="row">
        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=kundendaten">
                    <img src="public/images/icons/kunde.png" alt="Kundendaten">
                    <figcaption>Kundendaten</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=lieferantendaten">
                    <img src="public/images/icons/kunde.png" alt="Kunden">
                    <figcaption>Lieferantendaten</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=Kundenanfragen">
                    <img src="public/images/icons/Kundenanfrage.png" alt="Kundenanfragen">
                    <figcaption>Kundenanfragen</figcaption>
                </a>
            </figure>
        </div>

        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=emailings">
                    <img src="public/images/icons/Serienbriefe.png" alt="Emailings & Serienbriefe">
                    <figcaption>Emailings & Serienbriefe</figcaption>
                </a>
            </figure>
        </div>
    </div>

    <hr>

    <!-- BERICHTSWESEN -->
    <h2>Berichtswesen</h2>

    <div class="row">
        <div class="dashboard-block">
            <figure class="dashboardauswahl">
                <a href="index.php?section=personalreporting">
                    <img src="public/images/icons/feedback.png" alt="Personalreporting">
                    <figcaption>Personalreporting</figcaption>
                </a>
            </figure>
        </div>
    </div>


</div>












