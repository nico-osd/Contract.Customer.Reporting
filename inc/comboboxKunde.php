<?php

echo '<div>
      <select class="combobox" id="comboboxKunde" name="comboboxKunde">
        <option value=""></option>';

$query = mysql_query("select * from Kunde where Aktiv=1 order by Vorname, Nachname asc");

for ($i=0; $i < mysql_num_rows ($query); $i++) { 
    $kunde = mysql_fetch_array($query);

    if ($kunde['Firma']) {
        echo '<option value="' . $kunde['ID'] . '">' . $kunde['Firma'] . ' ' . $kunde['Vorname'] . ' ' . $kunde['Nachname'] . '</option>';
    } else {
        echo '<option value="' . $kunde['ID'] . '">' . $kunde['Vorname'] . ' ' . $kunde['Nachname'] . '</option>';
    }
}

echo '</select>
    </div>';

?>