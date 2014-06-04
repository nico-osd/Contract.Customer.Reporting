<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 03.06.14
 * Time: 21:54
 */

//Für Breadcrumb
use CCR\libs\Cookie;
Cookie::setBreadcrumbCookie(array("dashboard", "Artikel", "Artikel anlegen"));
?>


<div>
    <form class="formular" action="index.php?section=Artikel" method="post" id="form-create-article">
        <ul>
            <li>
                <h2>Artikel anlegen</h2>
                <span class="required_notification">* Benötigte Felder</span>
            </li>

            <li>
                <label for="bezeichnung">Bezeichnung:</label>
                <input id="bezeichnung" name="bezeichnung" type="text" placeholder="Bezeichnung" maxlength="45" required/>
            </li>



            <li>
                <label for="kategorie">Kategorie:</label>
                <select id="kategorie" name="kategorie" size="1" required>
                    <option value="" disabled selected>Kategorie auswählen</option>
                    <?php
                    if(isset($articleCategories)) {
                        for($i = 0; $i < sizeof($articleCategories); $i++) {
                            echo '<option value="' . $articleCategories[$i]['idKategorie'] . '">' . $articleCategories[$i]['name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </li>

            <li>
                <label for="einheit">Einheit:</label>
                <input id="einheit" name="einheit" type="text" placeholder="Einheit" maxlength="45"
                       required/>
            </li>
            <li>
                <label for="einkaufspreis">Einkaufspreis:</label>
                <input id="einkaufspreis" name="einkaufspreis" type="number" placeholder="Einkaufspreis"
                       maxlength="20" min="0" step="any" required/>
            </li>
            <li>
                <label for="nettopreis">Nettopreis:</label>
                <input id="nettopreis" name="nettopreis" type="number" placeholder="Nettopreis"
                       maxlength="20" min="0" step="any" required/>
            </li>
        </ul>
        <button class="submit buttonIEdisable" style="margin-top: 10px; margin-bottom: 2em;" name="createArticle"
                type="submit" form="form-create-article">Anlegen</button>
    </form>
</div>
