<?php
//Für Breadcrumb
use CCR\libs\Cookie;
Cookie::setBreadcrumbCookie(array("dashboard", "Artikel", "Artikel suchen"));
?>


<script type="text/javascript">
    $(function(){
        $("#form-search-article").customAjaxDisplayTable({
            outputDivIdName: "search-article-result",
            tableHeaderValues: [
                "Artikelnummer",
                "Bezeichnung",
                "Kategorie",
                "Einheit",
                "Einkaufspreis",
                "Nettopreis"
                ]
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
        <button class="submit buttonIEdisable buttonUnderForm" name="searchArticle"
                type="submit" form="form-search-article">Suchen</button>
    </form>


    <div id="search-article-result">
        <!-- TODO: Tabellenformatierung festlegen -->
        <table class="display-none" style="width:100%;" border="1px">

        </table>
    </div>



</div>