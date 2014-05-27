<?php

$_SESSION['site'] = array('dashboard', 'auftraege');

include ('inc/fun_auftrag.php');

postAuftragButtonLeiste ();

if (isset($_POST['speichernAuftrag'])) {
    if ($_POST['id']) {
        aendernAuftrag ();  
    } else {
        neuAuftrag (); 
    }

} elseif (isset($_POST['neuAuftrag'])) {
    postAuftrag (array());

} elseif (isset($_POST['neuAuftragAusAngebot'])) {
    $angebot = $_POST['neuAuftragAusAngebot'];
    neuAuftragAusAngebot ($angebot);

} elseif (isset($_POST['neuAuftragAusVorlage'])) {
    $auftragvorlage = $_POST['neuAuftragAusAngebot'];
    neuAuftragAusVorlage ($auftragvorlage);

} elseif (isset($_POST['detailsAuftrag'])) {
    $auftrag = $_POST['detailsAuftrag'];
    postAuftragDetails ($auftrag);

} elseif (isset($_POST['sucheAuftrage'])) {   
    $string = 'select *, Auftrag.ID as AuftragID, Auftrag.Datum as Auftragdatum, Kunde.Vorname as KVorname, Kunde.Nachname as KNachname,
        Mitarbeiter.Vorname as MVorname, Mitarbeiter.Nachname as MNachname, sum(Preis*Menge*((100-Rabatt)/100)) as Gesamtpreis from Auftrag
        left join Lieferung on Auftrag.Lieferung=Lieferung.ID
        left join Kunde on Auftrag.KundeID=Kunde.ID
        left join Mitarbeiter on Auftrag.MitarbeiterID=Mitarbeiter.ID
        left join AuftragArtikel on Auftrag.ID=AuftragArtikel.AuftragID
        where Auftrag.ID like "%' . $_POST['suche'] . '%" or concat(Kunde.Vorname," ",Kunde.Nachname) like "%' . $_POST['suche'] . '%"
            or concat(Mitarbeiter.Vorname," ",Mitarbeiter.Nachname) like "%' . $_POST['suche'] . '%" or Auftrag.Datum like "%' . $_POST['suche'] . '%"
        group by Auftrag.ID
        order by Auftrag.ID asc';
    $query = mysql_query($string);
    
    if (mysql_num_rows ($query) > 0) {
        echo '<div class="info">Suchergebnisse f&uuml;r "' . $_POST['suche'] . '"</div>';
    } else {
        echo '<div class="error">Keine Ergebnisse gefunden f&uuml;r "' . $_POST['suche'] . '"</div>';
    }

    postAuftragTabelle ($query);

} else {

    if (isset($_POST['aendernAuftrag'])) {
        $auftrag = $_POST['aendernAuftrag'];
        postAuftragBearbeiten ($auftrag);
    } elseif (isset($_POST['resetid'])) {
        $auftrag = $_POST['resetid'];
        postAuftragBearbeiten ($auftrag);
    } else {
        postAuftragListe ();
    }
}

?>