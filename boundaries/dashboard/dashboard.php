<?php
//Für Breadcrumb
use CCR\libs\Cookie;
Cookie::setBreadcrumbCookie(array("dashboard"));
?>

<hr>

<!-- TODO: Schriftart und style von figcaption == <p> ändern -->

<div id="dashboard"  >
    <div id="dashboard-accordion">
        <!-- AUFTRAGSMANAGEMENT -->
        <h3>Auftragsmanagement</h3>
        <div>
            <!-- erste Reihe -->
            <div class="dashboard-row clearfix">
                <div class="dashboard-block">
                    <a href="index.php?section=Artikel">
                        <img src="public/images/icons/artikel.jpg" alt="Artikel">
                        <p>Artikel verwalten</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=Lieferantenkonditionen">
                        <img src="public/images/icons/angebot.jpg" alt="Lieferantenkonditionen">
                        <p>Lieferantenkonditionen verwalten</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=Kundenangebote">
                        <img src="public/images/icons/angebot.jpg" alt="Kundenangebote">
                        <p>Kundenangebote verwalten</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=Angebotsstatus">
                        <img src="public/images/icons/angebot.jpg" alt="Angebotsstatus">
                        <p>Angebotsstatus ändern</p>
                    </a>
                </div>
            </div> <!-- end of erste Reihe -->

            <!-- zweite Reihe -->
            <div class="dashboard-row clearfix">
                <div class="dashboard-block">
                    <a href="index.php?section=Kundenaufträge">
                        <img src="public/images/icons/auftrag.jpg" alt="Kundenaufträge">
                        <p>Kundenaufträge abrufen</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=Kundenrechnungen">
                        <img src="public/images/icons/rechnung.jpg" alt="Kundenrechnungen">
                        <p>Kundenrechnungen abrufen</p>
                    </a>
                </div>
            </div> <!-- end of zweite Reihe -->
        </div> <!-- end of div auftragsmanagement -->


        <!-- KUNDENBEZIEHUNGSMANAGEMENT -->
        <h2>Kundenbeziehungsmanagement</h2>

        <div>
            <!-- erste Reihe -->
            <div class="dashboard-row">
                <div class="dashboard-block">
                    <a href="index.php?section=<?php echo htmlspecialchars("Kunde anlegen"); ?>">
                        <img src="public/images/icons/kundeanlegen.png" alt="Kunde anlegen">
                        <p>Kunde anlegen</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=kundengruppe">
                        <img src="public/images/icons/kundengruppe.png" alt="Kundengruppen">
                        <p>Kundengruppen</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=kundenanfragen">
                        <img src="public/images/icons/kundenanfragen.png" alt="Kundenanfragen">
                        <p>Anfrage aufnehmen</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=feedback">
                        <img src="public/images/icons/feedback.png" alt="Feedback">
                        <p>Kunden Feedback</p>
                    </a>
                </div>
            </div> <!-- end of erste Reihe -->


            <!-- zweite Reihe -->
            <div class="dashboard-row" style="clear: both">
                <div class="dashboard-block">
                    <a href="index.php?section=kundendaten">
                        <img src="public/images/icons/kunde.png" alt="Kundendaten">
                        <p>Kundendaten</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=lieferantendaten">
                        <img src="public/images/icons/kunde.png" alt="Kunden">
                        <p>Lieferantendaten</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=Kundenanfragen">
                        <img src="public/images/icons/Kundenanfrage.png" alt="Kundenanfragen">
                        <p>Kundenanfragen</p>
                    </a>
                </div>

                <div class="dashboard-block">
                    <a href="index.php?section=emailings">
                        <img src="public/images/icons/Serienbriefe.png" alt="Emailings & Serienbriefe">
                        <p>Emailings & Serienbriefe</p>
                    </a>
                </div>
            </div> <!-- end of zweite Reihe -->
        </div> <!-- end of div kundenbeziehungsmanagement -->


        <!-- BERICHTSWESEN -->
        <h2>Berichtswesen</h2>

        <div>
            <div class="dashboard-block">
                <figure class="dashboardauswahl">
                    <a href="index.php?section=personalreporting">
                        <img src="public/images/icons/feedback.png" alt="Personalreporting">
                        <figcaption>Personalreporting</figcaption>
                    </a>
                </figure>
            </div>
        </div>

    </div> <!-- end of dashboard-accordion -->
</div> <!-- end of dashboard -->












