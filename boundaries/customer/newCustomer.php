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
<form class="formular" action="index.php" method="post" id="customerform" name="customerform">
    <div id="newCustomerAccordion">
        <h2>Kunde anlegen</h2>

        <div id="newCustomerDetails">
            <span class="required_notification">* Ben&ouml;tigte Felder</span>
            <ul>
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
                    <input id="vorname" name="vorname" value="" type="text" placeholder="Vorname" maxlength="255"
                           required/>
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
            </ul>
        </div>
        <h2>Adresse suchen</h2>

        <div id="searchCustomerAdress">
            <ul>
                <li>
                    <label for="searchStreet">Stra&szlig;e:</label>
                    <input id="searchStreet" name="searchStreet" value="" type="text" placeholder="Stra&szlig;e"
                           maxlength="255"/>
                </li>
                <li>
                    <label for="searchOrt">Ort:</label>
                    <input id="searchOrt" name="searchOrt" value="" type="text" placeholder="Ort"
                           maxlength="255"/>
                </li>
                <li>
                    <button class="submit buttonIEdisable" class="submit buttonIEdisable" name="searchAdress"
                            type="submit">Suchen</button>
                </li>
            </ul>

        </div>
        <h2>Neue Adresse erstellen</h2>

        <div id="newCustomerAdress">
            <?php require BOUNDARIES . "templates/adress/newAdress.php" ?>
        </div>
    </div>
    <button class="submit buttonIEdisable" style="margin-top: 1em;" name="saveCustomer"
            type="submit" form="customerform">
        Speichern
    </button>
</form>