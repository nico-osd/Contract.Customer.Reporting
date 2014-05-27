// Das ist mein erster Konflikt !

<?php
	$_SESSION['site'] = array('dashboard', 'artikel');

    if (isset($_POST['speichernArtikel'])) {
        if ($_POST['id']) {
            $query = mysql_query('update Artikel set Name="' . $_POST['artikelname'] . '", Kategorie=' . $_POST['kategorie'] . ', Informationen="' . $_POST['informationen'] . '", Einkaufspreis=' . $_POST['einkaufspreis'] . ', Verkaufspreis=' . $_POST['verkaufspreis'] . ', Bestand=' . $_POST['bestand'] . ', Aktiv=' . $_POST['aktiv'] . '  where ID=' . $_POST['id']);
            
            if ($query) {
                echo "<div class='info'>Artikel erfolgreich ge&auml;ndert!</div>";
                postArtikelListe ();
                // TODO: Fehlerbehandlung
            } else {
                echo "<div class='error'>Artikel konnte nicht ge&auml;ndert werden!</div>";
            }
        } else {
            $query = mysql_query('insert into Artikel values (null,"' . $_POST['artikelname'] . '", ' . $_POST['kategorie'] . ', ' . $_POST['bestand'] . ', "' . $_POST['informationen'] . '", ' . $_POST['einkaufspreis'] . ', ' . $_POST['verkaufspreis'] . ', ' . $_POST['aktiv'] . ')');
            if ($query) {
                echo "<div class='info'>Artikel erfolgreich angelegt!</div>";
                postArtikelListe ();
                // TODO: Fehlerbehandlung
            } else {
                echo "<div class='error'>Artikel konnte nicht ge&auml;ndert werden!</div>";
            }
        }

    } elseif (isset($_POST['neuerArtikel'])) {
        postArtikel (array());

    } elseif (isset($_POST['detailsArtikel'])) {
        $artikel = $_POST['detailsArtikel'];
        postDetailsArtikel ($artikel);

    } elseif (isset($_POST['sucheArtikel'])) {
        postButtonLeiste ();
        
        $query = mysql_query('select *, Artikel.ID as ArtikelID, Artikel.Name as Artikelname, Kategorie.Name as Kategoriename from Artikel join kategorie on Artikel.Kategorie=Kategorie.ID 
                        where Artikel.Name like "%' . $_POST['suche'] . '%" or Kategorie.Name like "%' . $_POST['suche'] . '%" or Informationen like "%' . $_POST['suche'] . '%" order by Artikel.Name asc');
        
        if (mysql_num_rows ($query) > 0) {
            echo '<div class="info">Suchergebnisse f&uuml;r "' . $_POST['suche'] . '"</div>';
        } else {
            echo '<div class="error">Keine Ergebnisse gefunden f&uuml;r "' . $_POST['suche'] . '"</div>';
        }

        postArtikelTabelle ($query);
    } else {
        if (isset($_POST['aktivieren'])) {
            $aktiv = $_POST['aktivieren'];
            $query = mysql_query('update Artikel set Aktiv="1" where ID="' . $aktiv . '"');
            if ($query) {
                // TODO: Fehlerbehandlung
            }
        }

        if (isset($_POST['deaktivieren'])) {
            $aktiv = $_POST['deaktivieren'];
            $query = mysql_query('update Artikel set Aktiv="0" where ID="' . $aktiv . '"');
            if ($query) {
                // TODO: Fehlerbehandlung
            }
        }

        if (isset($_POST['aendernArtikel'])) {
            $artikel = $_POST['aendernArtikel'];
            postArtikelBearbeiten ($artikel);
        } elseif (isset($_POST['resetid'])) {
            $artikel = $_POST['resetid'];
            postArtikelBearbeiten ($artikel);
        } else {
            postArtikelListe ();
        }
    }

    function postArtikelListe () {
        postButtonLeiste ();

        $query = mysql_query("select *, Artikel.ID as ArtikelID, Artikel.Name as Artikelname, Kategorie.Name as Kategoriename from Artikel join kategorie on Artikel.Kategorie=Kategorie.ID order by Artikel.Name asc");
        
        postArtikelTabelle ($query);
    }

    function postButtonLeiste () {
        echo '<div class="buttonleiste">';

        if (isset($_POST['neuerArtikel']) || isset($_POST['aendernArtikel']) || isset($_POST['resetid'])) {
            if (isset($_POST['aendernArtikel'])) {
                $id = $_POST['aendernArtikel'];
            } elseif (isset($_POST['resetid'])) {
                $id = $_POST['resetid'];
            }

            echo '<a href="index.php?section=artikel"><button class="submit left r10" name="artikel" type="submit">Zur Artikel&uuml;bersicht</button></a>';
            echo '<form action="index.php?section=artikel" method="post">
                    <input type="hidden" name="resetid" value="' . $id . '"> 
                    <button class="submit left r10">Reset</button>
                </form>';
            echo '<button class="submit left buttonIEdisable" name="speichernArtikel" type="submit" form="artikelform">Speichern</button>';
       
        } elseif (isset($_POST['detailsArtikel'])) {
            $id = $_POST['detailsArtikel'];

            echo '<a href="index.php?section=artikel"><button class="submit left r10" name="alleArtikel" type="submit">Alle Artikel anzeigen</button></a>';
            echo '<form action="index.php?section=artikel" method="post">
                    <input type="hidden" name="aendernArtikel" value="' . $id . '"> 
                    <button class="submit left">&Auml;ndern</button>
                </form>';

        } else {
            if (isset($_POST['sucheArtikel'])) {
                echo '<a href="index.php?section=artikel"><button class="submit left r10" name="alleArtikel" type="submit">Alle Artikel anzeigen</button></a>';
            } 

            echo '<form method="post" action="index.php?section=artikel" class="left r10">
                <button class="submit" name="neuerArtikel" type="submit">Artikel hinzuf&uuml;gen</button>
            </form>';

            echo '<a href="index.php?section=dashboard"><button class="submit left r10" name="dashboard" type="submit">Zum Dashboard</button></a>';

            echo '<form method="post" action="index.php?section=artikel" id="searchArtikel" class="right">
                <input class="suche" name="suche" placeholder="Suche" pattern=".+" type="search" />
                <button class="submit" name="sucheArtikel" type="submit">Suche</button>
            </form>';
        }
        echo '</div>';
    }

    function postArtikelTabelle ($query) {
        echo '<table class="liste clear">
            <tr>
                <th>Name</th>
                <th>Kategorie</th>
                <th class="textright">Verkaufspreis</th>
                <th class="textright">Bestand</th>
                <th>Status</th>
                <th>&Auml;ndern</th>
            </tr>';
        for ($i=0; $i < mysql_num_rows ($query); $i++) { 
            $artikel = mysql_fetch_array($query);
            if ($i % 2 == 0) {
                echo '<tr>';
            } else {
                echo '<tr class="farbigeZeile">';
            }

            echo '<td>
                        <form action="index.php?section=artikel" method="post">
                            <input type="hidden" name="detailsArtikel" value="' . $artikel['ArtikelID'] . '"> 
                            <button class="linkbutton">' . $artikel['Artikelname'] . '</button>
                        </form>
                    </td>';
            echo '
                        <td>' . $artikel['Kategoriename'] . '</td>
                        <td class="textright">' . $artikel['Verkaufspreis'] . ' &euro;</td>
                        <td class="textright">' . $artikel['Bestand'] . '</td>';
            if ($artikel['Aktiv'] == '1') {
                echo '
                    <td>
                        <form action="index.php?section=artikel" method="post">
                            <input type="hidden" name="deaktivieren" value="' . $artikel['ArtikelID'] . '"> 
                            <button class="linkbutton">Deaktivieren</button>
                        </form>
                    </td>';
            } else {
                echo '
                    <td>
                        <form action="index.php?section=artikel" method="post">
                            <input type="hidden" name="aktivieren" value="' . $artikel['ArtikelID'] . '"> 
                            <button class="linkbutton">Aktivieren</button>
                        </form>
                    </td>';
            }        
            echo '
                    <td>
                        <form action="index.php?section=artikel" method="post">
                            <input type="hidden" name="aendernArtikel" value="' . $artikel['ArtikelID'] . '"> 
                            <button class="linkbutton">&Auml;ndern</button>
                        </form>
                    </td>
                </tr>';
        }
        echo '</table>';
    }

    function postArtikelBearbeiten ($artikel) {
        $query = mysql_query("select *, Artikel.ID as ArtikelID, Artikel.Name as Artikelname, Kategorie.Name as Kategoriename from Artikel join kategorie on Artikel.Kategorie=Kategorie.ID where Artikel.ID=" . $artikel);
        $row = mysql_fetch_array($query);
        postArtikel($row);
    }

    function postArtikel ($artikel) {
        postButtonLeiste ();

        echo '
            <form class="formular" action="index.php?section=artikel" method="post" id="artikelform" name="artikelform">
            <ul>
                <li>
                     <h2>Artikel hinzuf&uuml;gen</h2>
                     <span class="required_notification">* Ben&ouml;tigte Felder</span>
                </li>
                <li>
                    <label for="artikelname">Artikelname:</label>
                    <input id="artikelname" name="artikelname" value="' . $artikel['Artikelname'] . '" type="text" placeholder="Artikelname" maxlength="30" required />
                </li>
                 <li>
                    <label for="kategorie">Kategorie:</label>
                    <select id="kategorie" name="kategorie" size="1" required>';
        $result = mysql_query ("select * from Kategorie");
        $zeilenanzahl = mysql_num_rows ($result);
        echo '<option value=""></option>';
        for ($i = 1; $i <= $zeilenanzahl; $i++) {
            $row = mysql_fetch_assoc($result);
            if ($row['Name'] == $artikel['Kategoriename']) {
                echo '<option value="' . $row['ID'] . '" selected="selected">' . $row['Name'] . '</option>';
            } else {
                echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
            }
        }
        echo '
                    </select>
                </li>
                <li>
                    <label for="informationen">Informationen:</label>
                    <textarea id="informationen" name="informationen" placeholder="Artikelinformationen eintragen" maxlength="300" required>' . $artikel['Informationen'] . '</textarea>
                </li>
                <li>
                    <label for="einkaufspreis">Einkaufspreis:</label>
                    <input id="einkaufspreis" name="einkaufspreis" pattern="^[1-9]+[0-9]*(\,[0-9]{1,2})?$" value="' . $artikel['Einkaufspreis'] . '" type="text" placeholder="Einkaufspreis" maxlength="8" required />
                    <span class="form_hint">in Euro</span>
                </li>
                <li>
                    <label for="verkaufspreis">Verkaufspreis:</label>
                    <input id="verkaufspreis" name="verkaufspreis" pattern="^[1-9]+[0-9]*(\,[0-9]{1,2})?$" value="' . $artikel['Verkaufspreis'] . '" type="text" placeholder="Verkaufspreis" maxlength="8" required />
                    <span class="form_hint">in Euro</span>               
                </li>
                <li>
                    <label for="bestand">Bestand:</label>
                    <input id="bestand" name="bestand" pattern="^[1-9]+[0-9]*$" value="' . $artikel['Bestand'] . '" type="text" placeholder="Bestand" maxlength="4" required />
                </li>
                <li>
                    <label for="aktiv">Aktiv:</label>
                    <select id="aktiv" name="aktiv" size="1" required>
                        <option></option>';
        if ($artikel['Aktiv'] == 0) {
            echo '<option value="' . 0 . '" selected="selected">Nein</option>';
        } else {
            echo '<option value="' . 0 . '">Nein</option>';
        }
        if ($artikel['Aktiv'] == 1) {
            echo '<option value="' . 1 . '" selected="selected">Ja</option>';
        } else {
            echo '<option value="' . 1 . '">Ja</option>';
        }
        echo '
                    </select>
                    <input type="hidden" name="id" value="' . $artikel['ArtikelID'] . '"> 
                </li>
                <li>
                    <button class="submit buttonIEenable" name="speichernArtikel" type="submit">Speichern</button>
                </li>
            </ul>
        </form>
        ';
    }

    function postDetailsArtikel ($artikel) {
        postButtonLeiste ();

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
            echo'</tr>
        </table>';
    }
?>