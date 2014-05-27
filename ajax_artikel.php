<?php

	$con = mysql_connect("wi-projectdb.technikum-wien.at:3306", "SS13-BVZ2-FST-3", "DbPass4BVZ2-3");
    mysql_select_db("ss13-bvz2-fst-3");

	$query = mysql_query("select * from Artikel where Name='" . $_POST['artikelname'] . "'");
	$artikel = mysql_fetch_array($query);

	echo "<li>" . $artikel['Name'] . '<input name="artikel[]" type="number" value="1" max="' . $artikel['Bestand'] . '" min="1" pattern="^[1-9]+[0-9]*$"> von ' . $artikel['Bestand'];
	echo '<button type="button" class="delete l10" name="deleteArtikel" onclick="$(this).parent().remove(); setRequiredArtikel();">L&ouml;schen</button>
	</li>';

?>