<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 07.06.14
 * Time: 09:15
 */

//Für Breadcrumb
use CCR\libs\Cookie;
Cookie::setBreadcrumbCookie(array("dashboard", "Artikel", "Artikel ändern"));

?>


<div>
    <form class="formular" action="index.php?section=Artikel" method="post" id="form-edit-article">
        <ul>
            <li>
                <h2>Artikel ändern</h2>
                <span class="required_notification">* Benötigte Felder</span>
            </li>

            <li>
                <label for="bezeichnung">Bezeichnung:</label>
                <input id="bezeichnung" name="bezeichnung" type="text" placeholder="Bezeichnung" maxlength="45"
                       value="<?php echo $singleArticleInfo[0]['bezeichnung']; ?>" required/>
            </li>



            <li>
                <label for="kategorie">Kategorie:</label>
                <select id="kategorie" name="kategorie" size="1" required>
                    <option value="" disabled>Kategorie auswählen</option>
                    <?php
                    if(isset($articleCategories)) {
                        $isSelected = "";

                        for($i = 0; $i < sizeof($articleCategories); $i++) {
                            if($singleArticleInfo[0]['name'] == $articleCategories[$i]['name']) {
                                $isSelected = "selected";
                            }
                            echo '<option '. $isSelected . ' value="' . $articleCategories[$i]['idKategorie'] . '">' . $articleCategories[$i]['name'] . '</option>';
                            $isSelected = "";
                        }
                    }
                    ?>
                </select>
            </li>

            <li>
                <label for="einheit">Einheit:</label>
                <input id="einheit" name="einheit" type="text" placeholder="Einheit" maxlength="45"
                       value="<?php echo $singleArticleInfo[0]['einheit']; ?>" required/>
            </li>
            <li>
                <label for="einkaufspreis">Einkaufspreis:</label>
                <input id="einkaufspreis" name="einkaufspreis" type="number" placeholder="Einkaufspreis"
                       value="<?php echo $singleArticleInfo[0]['einkaufspreis']; ?>" maxlength="20" min="0" step="any" required/>
            </li>
            <li>
                <label for="nettopreis">Nettopreis:</label>
                <input id="nettopreis" name="nettopreis" type="number" placeholder="Nettopreis"
                       value="<?php echo $singleArticleInfo[0]['nettopreis']; ?>" maxlength="20" min="0" step="any" required/>
            </li>
        </ul>

        <!-- Hidden input Feld, wird verwendet für die ID des Artikels welcher upgedatet werden soll -->
        <input hidden="hidden" name="idArtikel" value="<?php echo $_GET['val'];?>">

        <button class="submit buttonIEdisable" style="margin-top: 10px; margin-bottom: 2em;" name="saveEditArticle"
                type="submit" form="form-edit-article">Ändern</button>
    </form>
</div>
