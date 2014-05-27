<?php

echo '<div class="left">
      <select class="combobox" id="comboboxArtikel" name="comboboxArtikel">
        <option value=""></option>';

$query = mysql_query("select * from Artikel where Aktiv=1 order by Name asc");

for ($i=0; $i < mysql_num_rows ($query); $i++) { 
    $artikel = mysql_fetch_array($query);

    echo '<option value="' . $artikel['ID'] . '">' . $artikel['Name'] . '</option>';
}

echo '</select>
    </div>';

?>