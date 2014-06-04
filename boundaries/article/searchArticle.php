

<div>
    <form class="formular" action="index.php" method="post" id="form-search-article">
        <ul>
            <li>
                <h2>Artikel suchen</h2>
                <span class="required_notification">* Benötigte Felder</span>
            </li>

            <li>
                <label for="artikelnummer">Artikelnummer:</label>
                <input id="artikelnummer" name="artikelnummer" type="number" placeholder="Artikelnummer" maxlength="20">
            </li>

            <li>
                <label for="bezeichnung">Einheit:</label>
                <input id="bezeichnung" name="bezeichnung" type="text" placeholder="Bezeichnung" maxlength="45">
            </li>

        </ul>
        <button class="submit buttonIEdisable" style="margin-top: 10px; margin-bottom: 2em;" name="searchArticle"
                type="submit" form="form-search-article">Suchen</button>
    </form>
</div>