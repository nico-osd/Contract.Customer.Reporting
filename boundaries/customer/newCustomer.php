<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 02.06.14
 * Time: 19:35
 */

use CCR\libs\Cookie;

Cookie::setBreadcrumbCookie(array("dashboard", "Kunde anlegen"));

$customergroups = new \CCR\entities\Customergroups();
?>
<div>
    <form class="formular" action="index.php?section=newCustomer" method="post" id="customerform" name="customerform">
        <ul>
            <li>
                <h2>Kunde anlegen</h2>
                <span class="required_notification">* Ben&ouml;tigte Felder</span>
            </li>
            <li>
                <label for="kundengruppe">Kundengruppe:</label>
                <select id="kundengruppe" size="1" required>
                    <option value="-1" selected>Neue Gruppe anlegen</option>
                    <?php
                    $result = $customergroups->getCustomergroupsIDsNames();

                    for ($i = 0; $i < $result->num_rows; $i++)
                        echo '<option value="' . $result[$i]['idKundengruppe'] . '">' . $result[$i]['name'] . '</option>';
                    ?>
                </select>
            </li>
            <li>
                <label for="vorname">Vorname:</label>
                <input id="vorname" name="vorname" value="" type="text" placeholder="Vorname" maxlength="255" required/>
            </li>
            <li>
                <label for="nachname">Nachname:</label>
                <input id="nachname" name="nachname" value="" type="text" placeholder="Nachname" maxlength="255"
                       required/>
            </li>
            <li>
                <label for="telefonnummer">Telefonnummer:</label>
                <input id="telefonnummer" name="telefonnummer" value="" type="text" placeholder="Telefonnummer"
                       maxlength="255" required/>
            </li>
            <li>
                <label for="email">E-Mail:</label>
                <input id="email" name="email" value="" type="text" placeholder="E-Mail Adresse"
                       maxlength="255"/>
            </li>
            <li>
                <ul>
                    <li id="newCustomerNewAdress">
                        <h3>Neue Adresse erstellen</h3>
                    </li>
                    <div id="newCustomerAdress" class="" style="display: none">
                        <li style="padding:12px;border-bottom:1px solid #eee;position:relative;">
                            <label for="ort">Ort:</label>
                            <input id="ort" name="ort" value="" type="text" placeholder="Ort" maxlength="255"
                                   required/>
                        </li>
                        <li>
                            <label for="postleitzahl">PLZ:</label>
                            <input style="width: auto" id="postleitzahl" name="postleitzahl" value="" type="number"
                                   placeholder="#"
                                   min="1010" max="9990" required/>
                        </li>
                        <li>
                            <label for="strasse">Stra&szlig;e:</label>
                            <input id="strasse" name="strasse" value="" type="text" placeholder="Stra&szlig;e"
                                   maxlength="255" required/>
                        </li>
                        <li>
                            <label for="hausnummer">Hausnummer</label>
                            <input style="width: auto" id="hausnummer" name="hausnummer" value="" type="number"
                                   placeholder="#"
                                   size="4"
                                   max="1000" min="1" required/>
                        </li>
                        <li>
                            <label for="stiege">Stiege</label>
                            <input style="width: auto" id="stiege" name="stiege" value="" type="number" placeholder="#"
                                   size="4" max="1000" min="1"/>
                        </li>
                        <li>
                            <label for="tuernummer">T&uuml;rnummer</label>
                            <input style="width: auto" id="tuernummer" name="tuernummer" value="" type="number"
                                   placeholder="#"
                                   size="4" max="1000" min="1"/>
                        </li>
                        <li style="padding:12px;border-bottom:1px solid #eee;position:relative;">
                            <label for="land">Land</label>
                            <input id="land" name="land" value="&Ouml;sterreich" type="text" placeholder="Land"
                                   maxlength="255"
                                   required/>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
        <button class="submit left buttonIEdisable" style="margin-top: 10px; margin-bottom: 2em;" name="saveCustomer"
                type="submit" form="customerform">
            Speichern
        </button>
    </form>
</div>

<script>
    $("#newCustomerNewAdress").click(function () {
        $("#newCustomerAdress").toggle("blind", 1000);
    });
</script>