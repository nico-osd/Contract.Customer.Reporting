<?php

echo '<div>
      <select class="combobox" id="comboboxMitarbeiter" name="comboboxMitarbeiter">
        <option value=""></option>';

$query = mysql_query("select * from Mitarbeiter where Aktiv=1 order by Vorname, Nachname asc");

for ($i=0; $i < mysql_num_rows ($query); $i++) { 
    $mitarbeiter = mysql_fetch_array($query);

    if ($_SESSION['id'] == $mitarbeiter['ID'] && !isset($angebot['MitarbeiterID'])) {
    	echo '<option selected="selected" value="' . $mitarbeiter['ID'] . '">' . $mitarbeiter['Vorname'] . ' ' . $mitarbeiter['Nachname'] . '</option>';
    } elseif ($angebot['MitarbeiterID'] == $mitarbeiter['ID']) {
		echo '<option selected="selected" value="' . $mitarbeiter['ID'] . '">' . $mitarbeiter['Vorname'] . ' ' . $mitarbeiter['Nachname'] . '</option>';
    } else {
    	echo '<option value="' . $mitarbeiter['ID'] . '">' . $mitarbeiter['Vorname'] . ' ' . $mitarbeiter['Nachname'] . '</option>';
    }
}

echo '</select>
    </div>';

?>