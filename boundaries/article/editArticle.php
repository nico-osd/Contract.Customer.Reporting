<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 06.06.14
 * Time: 19:05
 */


//Für Breadcrumb
use CCR\libs\Cookie;
Cookie::setBreadcrumbCookie(array("dashboard", "Artikel", "Artikel ändern"));
?>

<script type="text/javascript">
    $(function(){
        $("#form-search-article").customAjaxDisplayTable({
            outputDivIdName: "edit-article-result",
            tableHeaderValues: [
                "Artikelnummer",
                "Bezeichnung",
                "Kategorie",
                "Einheit",
                "Einkaufspreis",
                "Nettopreis",
                "Ändern"
            ],
            actionFieldCode: 2,
            redirectLocation: "section=Artikel speichern",
            primaryKeyTableColumnName: "idArtikel"
        });
    });
</script>


<div>
    <form id="form-search-article" class="formular" action="index.php?section=Artikel suchen&action=search" method="post">
        <ul>
            <li>
                <h2>Artikel suchen</h2>
                <span class="required_notification">* Benötigte Felder</span>
            </li>

            <li>
                <label for="artikelnummer">Artikelnummer:</label>
                <input id="artikelnummer" name="artikelnummer" type="number" value="" placeholder="Artikelnummer" maxlength="20">
            </li>

            <li>
                <label for="bezeichnung">Bezeichnung:</label>
                <input id="bezeichnung" name="bezeichnung" type="text" value="" placeholder="Bezeichnung" maxlength="45">
            </li>

        </ul>
        <button class="submit buttonIEdisable" style="margin-top: 10px; margin-bottom: 2em;" name="searchArticle"
                type="submit" form="form-search-article">Suchen</button>
    </form>


    <div id="edit-article-result">
        <!-- TODO: Tabellenformatierung festlegen -->
        <table class="display-none" style="width:100%;" border="1px">

        </table>
    </div>
</div>



















