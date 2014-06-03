
<?php
/**
 * Created by PhpStorm.
 * User: Patrik
 * Date: 31.05.14
 * Time: 08:53
 *
 * Solange sie im gleichen Ordner sind funktioniert das. ok jez funkts glaub ich
 *
 * du musst alle benoetigten Klassen/Files includen. ja ich bin bissel durcheinander gekommen mit dem "use"
 * z.B. Wenn du einen Namespace hast (absolut: CCR\xx\Kennzahlen\KLASSENNAME), dann musst du ein Use (=Import in Java)
 * verwenden. Ansonsten findet er die Klasse nicht (=Import in Java vergessen).ok
 * thx - passt bis dann.
 */

use CCR\xx\Kennzahlen\Kennzahlen;

if(!empty($_POST['Datum1']) && !empty($_POST['Datum2'])){
    $_datum1 = $_POST['Datum1'];
    $_datum2 = $_POST['Datum2'];

    include('Kennzahlen.php');
    $_kz = new Kennzahlen();
    $_kz->betrachtungsZeitraum($_datum1, $_datum2);

}


?><div id="dashboard">
<h1 style="color: Blue; font-family:Garamond">Dashboard</h1>
 <h2 style="color: Blue; font-family:Garamond">Bitte waehlen sie einen Betrachtungszeitraum</h2>
<form action="" method="post">
    <br/>
        <input style="border: solid lime" type="date" value="" name="Datum1">'
    <br/>
        <input style="border: solid lime"type="date" value="" name="Datum2">
    <br/>
    <input style="cursor: pointer; font: 12px Verdana,sans-serif; color: #FFFFFF;
     background-color: #A1B9C5; width: 140px; padding: 3px; line-height: 130%;"
        type="submit" value="Auswahl bestaetigen">
</form>
    </div>