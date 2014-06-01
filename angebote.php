<?php
$_SESSION['site'] = array('dashboard', 'angebote');

if (isset($_POST['speichernAngebot'])) {
    if ($_POST['id']) {
        $query = mysql_query('update Artikel set Name="' . $_POST['artikelname'] . '", Kategorie=' . $_POST['kategorie'] . ', Informationen="' . $_POST['informationen'] . '", Einkaufspreis=' . $_POST['einkaufspreis'] . ', Verkaufspreis=' . $_POST['verkaufspreis'] . ', Bestand=' . $_POST['bestand'] . ', Aktiv=' . $_POST['aktiv'] . '  where ID=' . $_POST['id']);

        if ($query) {
            echo "<div class='info'>Artikel erfolgreich ge&auml;ndert!</div>";
            postAngeboteListe();
            // TODO: Fehlerbehandlung
        } else {
            echo "<div class='error'>Artikel konnte nicht ge&auml;ndert werden!</div>";
        }
    } else {
        $string = 'insert into Artikel values (null,"' . $_POST['artikelname'] . '", ' . $_POST['kategorie'] . ', ' . $_POST['bestand'] . ', "' . $_POST['informationen'] . '", ' . $_POST['einkaufspreis'] . ', ' . $_POST['verkaufspreis'] . ', ' . $_POST['aktiv'] . ')';
        var_dump($string);

        //$query = mysql_query($string);
        if ($query) {
            echo "<div class='info'>Artikel erfolgreich angelegt!</div>";
            postAngeboteListe();
            // TODO: Fehlerbehandlung
        } else {
            echo "<div class='error'>Artikel konnte nicht ge&auml;ndert werden!</div>";
        }
    }

} elseif (isset($_POST['neuesAngebot'])) {
    postAngebot(array());

} elseif (isset($_POST['detailsAngebot'])) {
    $artikel = $_POST['detailsAngebot'];
    postDetailsAngebot($artikel);

} elseif (isset($_POST['sucheAngebote'])) {
    postButtonLeiste();

    $string = 'select *, Angebot.ID as AngebotID, Angebot.Datum as Angebotdatum, Kunde.Vorname as KVorname, Kunde.Nachname as KNachname,
            Mitarbeiter.Vorname as MVorname, Mitarbeiter.Nachname as MNachname, sum(Preis*Menge) as Gesamtpreis from Angebot
            left join Lieferung on Angebot.Lieferung=Lieferung.ID
            left join Kunde on Angebot.KundeID=Kunde.ID
            left join Mitarbeiter on Angebot.MitarbeiterID=Mitarbeiter.ID
            left join AngebotArtikel on Angebot.ID=AngebotArtikel.AngebotID
            where Angebot.ID like "%' . $_POST['suche'] . '%" or concat(Kunde.Vorname," ",Kunde.Nachname) like "%' . $_POST['suche'] . '%"
                or concat(Mitarbeiter.Vorname," ",Mitarbeiter.Nachname) like "%' . $_POST['suche'] . '%" or Angebot.Datum like "%' . $_POST['suche'] . '%"
            group by Angebot.ID
            order by Angebot.ID asc';
    $query = mysql_query($string);

    if (mysql_num_rows($query) > 0) {
        echo '<div class="info">Suchergebnisse f&uuml;r "' . $_POST['suche'] . '"</div>';
    } else {
        echo '<div class="error">Keine Ergebnisse gefunden f&uuml;r "' . $_POST['suche'] . '"</div>';
    }

    postAngeboteTabelle($query);
} else {

    if (isset($_POST['aendernAngebot'])) {
        $angebot = $_POST['aendernAngebot'];
        postAngebotBearbeiten($angebot);
    } elseif (isset($_POST['resetid'])) {
        $angebot = $_POST['resetid'];
        postAngebotBearbeiten($angebot);
    } else {
        postAngeboteListe();
    }
}

function postAngeboteListe()
{
    postButtonLeiste();

    $query = mysql_query("select *, Angebot.ID as AngebotID, Angebot.Datum as Angebotdatum, Kunde.Vorname as KVorname, Kunde.Nachname as KNachname,
            Mitarbeiter.Vorname as MVorname, Mitarbeiter.Nachname as MNachname, sum(Preis*Menge) as Gesamtpreis from Angebot
            left join Lieferung on Angebot.Lieferung=Lieferung.ID
            left join Kunde on Angebot.KundeID=Kunde.ID
            left join Mitarbeiter on Angebot.MitarbeiterID=Mitarbeiter.ID
            left join AngebotArtikel on Angebot.ID=AngebotArtikel.AngebotID
            group by Angebot.ID
            order by Angebot.ID asc");

    postAngeboteTabelle($query);
}

function postButtonLeiste()
{
    echo '<div class="buttonleiste">';

    if (isset($_POST['neuesAngebot']) || isset($_POST['aendernAngebot']) || isset($_POST['resetid'])) {
        if (isset($_POST['aendernAngebot'])) {
            $id = $_POST['aendernAngebot'];
        } elseif (isset($_POST['resetid'])) {
            $id = $_POST['resetid'];
        }

        echo '<a href="index.php?section=angebote"><button class="submit left r10" name="angebot" type="submit">Zur Angebots&uuml;bersicht</button></a>';
        echo '<form action="index.php?section=angebote" method="post">
                    <input type="hidden" name="resetid" value="' . $id . '"> 
                    <button class="submit left r10">Reset</button>
                </form>';
        echo '<button class="submit left buttonIEdisable" name="speichernAngebot" type="submit" form="angebotform">Speichern</button>';

    } elseif (isset($_POST['detailsAngebot'])) {
        $id = $_POST['detailsAngebot'];

        echo '<a href="index.php?section=angebote"><button class="submit left r10" name="alleAngebote" type="submit">Alle Angebote anzeigen</button></a>';
        echo '<form action="index.php?section=angebote" method="post">
                    <input type="hidden" name="aendernAngebot" value="' . $id . '"> 
                    <button class="submit left r10">&Auml;ndern</button>
                </form>';
        echo '<form action="pdf_angebot.php" method="post">
                    <input type="hidden" name="erstellePDF" value="' . $id . '"> 
                    <button class="submit left">PDF erstellen</button>
                </form>';

    } else {
        if (isset($_POST['sucheAngebote'])) {
            echo '<a href="index.php?section=angebote"><button class="submit left r10" name="alleAngebote" type="submit">Alle Angebote anzeigen</button></a>';
        }

        echo '<form method="post" action="index.php?section=angebote" class="left r10">
                <button class="submit" name="neuesAngebot" type="submit">Angebot hinzuf&uuml;gen</button>
            </form>';

        echo '<a href="index.php?section=dashboard"><button class="submit left r10" name="dashboard" type="submit">Zum Dashboard</button></a>';

        echo '<form method="post" action="index.php?section=angebote" id="searchAngebot" class="right">
                <input class="suche" name="suche" placeholder="Suche" pattern=".+" type="search" />
                <button class="submit" name="sucheAngebote" type="submit">Suche</button>
            </form>';
    }
    echo '</div>';
}

function postAngeboteTabelle($query)
{
    echo '<table class="liste clear">
            <tr>
                <th>Nummer</th>
                <th>Datum</th>
                <th class="textright">Preis</th>
                <th>Kunde</th>
                <th>Mitarbeiter</th>
                <th>&Auml;ndern</th>
            </tr>';
    for ($i = 0; $i < mysql_num_rows($query); $i++) {
        $angebot = mysql_fetch_array($query);
        if ($i % 2 == 0) {
            echo '<tr>';
        } else {
            echo '<tr class="farbigeZeile">';
        }

        echo '<td>
                        <form action="index.php?section=angebote" method="post">
                            <input type="hidden" name="detailsAngebot" value="' . $angebot['AngebotID'] . '"> 
                            <button class="linkbutton">' . $angebot['AngebotID'] . '</button>
                        </form>
                    </td>
                    <td>' . $angebot['Datum'] . '</td>
                    <td class="textright">' . $angebot['Gesamtpreis'] . ' €</td>
                    <td>' . $angebot['KVorname'] . ' ' . $angebot['KNachname'] . '</td>
                    <td>' . $angebot['MVorname'] . ' ' . $angebot['MNachname'] . '</td>
                    <td>
                        <form action="index.php?section=angebote" method="post">
                            <input type="hidden" name="aendernAngebot" value="' . $angebot['AngebotID'] . '"> 
                            <button class="linkbutton">&Auml;ndern</button>
                        </form>
                    </td>
                </tr>';
    }
    echo '</table>';
}

function postAngebotBearbeiten($artikel)
{
    $query = mysql_query("select *, Artikel.ID as ArtikelID, Artikel.Name as Artikelname, Kategorie.Name as Kategoriename from Artikel join kategorie on Artikel.Kategorie=Kategorie.ID where Artikel.ID=" . $artikel);
    $row = mysql_fetch_array($query);
    postAngebot($row);
}

function postAngebot($angebot)
{
    postButtonLeiste();

    echo '
            <form class="formular" action="index.php?section=angebote" method="post" id="angebotform" name="angebotform" onclick="return checkLieferung(this);">
            <ul>
                <li>
                     <h2>Angebot hinzuf&uuml;gen</h2>
                     <span class="required_notification">* Ben&ouml;tigte Felder</span>
                </li>
                <li>
                    <label for="informationen">Informationen:</label>
                    <textarea id="informationen" name="informationen" placeholder="Angebotsinformationen eintragen" maxlength="300">' . $angebot['Informationen'] . '</textarea>
                </li>
                <li>
                    <label for="comboboxKunde_input">Kunde:</label>';
    include('inc/comboboxKunde.php');
    echo '</li>
            <li>
                    <label for="comboboxMitarbeiter_input">Mitarbeiter</label>';
    include('inc/comboboxMitarbeiter.php');
    echo '</li>
            <li>
                    <label for="comboboxArtikel_input">Artikel</label>';
    include('inc/comboboxArtikel.php');
    echo '<button type="button" class="submit l10" name="addArtikel" onclick="addComboboxArtikel();">Hinzuf&uuml;gen</button>
                <ul id="ul_artikel">
                </ul>
                </li>
                <li>
                    <label for="rabatt">Rabatt:</label>
                    <input id="rabatt" name="rabatt" pattern="^[1-9]+[0-9]?$" value="' . $angebot['Rabatt'] . '" type="text" placeholder="Rabatt" maxlength="2" />
                    <span class="form_hint">in Prozent</span>               
                </li>
                <li>
                    <label for="lieferung">Lieferung:</label>
                    <input id="lieferung" type="checkbox" name="lieferung" value="1">
                </li>
                <li>
                    <label for="lieferdatum">Lieferdatum:</label>
                    <input id="lieferdatum" type="date" name="lieferdatum" placeholder="YYYY-MM-DD" value="' . date("Y-m-d", time()) . '" disabled>
                </li>
                <li>
                    <label for="montage">Montage:</label>
                    <input id="montage" type="checkbox" name="montage" value="1" disabled>
                </li>
                <li>
                    <input type="hidden" name="id" value="' . $angebot['AngebotID'] . '"> 
                    <button class="submit buttonIEenable" name="speichernAngebot" type="submit">Speichern</button>
                </li>
            </ul>
        </form>
        ';
}

function postDetailsAngebot($artikel)
{
    postButtonLeiste();

    $query = mysql_query("select *, Artikel.ID as ArtikelID, Artikel.Name as Artikelname, Kategorie.Name as Kategoriename from Artikel join kategorie on Artikel.Kategorie=Kategorie.ID where Artikel.ID=" . $artikel);
    $artikel = mysql_fetch_array($query);

    echo '
        <table class="detailliste">
            <tr>
                <td colspan="2"><h2>Artikel "' . $artikel['Artikelname'] . '"</h2></td>
            </tr>
            <tr>
                <td class="beschriftung">Kategorie:</td>
                <td>' . $artikel['Kategoriename'] . '</td>
            </tr>
            <tr>
                <td class="beschriftung">Informationen:</td>
                <td>' . $artikel['Informationen'] . '</td>
            </tr>
            <tr>
                <td class="beschriftung">Einkaufspreis:</td>
                <td>' . $artikel['Einkaufspreis'] . '</td>
            </tr>
            <tr>
                <td class="beschriftung">Verkaufspreis:</td>
                <td>' . $artikel['Verkaufspreis'] . '</td>
            </tr>
            <tr>
                <td class="beschriftung">Bestand:</td>
                <td>' . $artikel['Bestand'] . '</td>
            </tr>
            <tr>
                <td class="beschriftung">Aktiv:</td>';
    if ($artikel['Aktiv'] == 1) {
        echo '<td>Ja</td>';
    } else {
        echo '<td>Nein</td>';
    }
    echo '</tr>
        </table>';
}

?>