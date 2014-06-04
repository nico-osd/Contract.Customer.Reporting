<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 03.06.14
 * Time: 22:22
 */

use CCR\controllers\ArticleController;

// Artikel Controller
$article = new ArticleController();

/**
 * Wird ausgeführt wenn user auf submit Button klickt
 */
if(isset($_POST['createArticle'])) {

    $articleTableData = array(
        "bezeichnung" => $_POST['bezeichnung'],
        "einheit" => $_POST['einheit'],
        "einkaufspreis" => $_POST['einkaufspreis'],
        "nettopreis" => $_POST['nettopreis']
    );

    $artikelHasKategorieData = array(
        "Kategorie_idKategorie" => $_POST['kategorie']
    );

    $article->createArticle($articleTableData, $artikelHasKategorieData);
}

/**
 * Wird ausgeführt wenn user auf submit Button mit name=searchArticle klick
 */
if(isset($_POST['serchArticle'])) {

    //TODO: Anpassen auf Artikel suchen -> AJAX
    $articleTableData = array(
        "bezeichnung" => $_POST['bezeichnung'],
        "einheit" => $_POST['einheit'],
        "einkaufspreis" => $_POST['einkaufspreis'],
        "nettopreis" => $_POST['nettopreis']
    );

    $artikelHasKategorieData = array(
        "Kategorie_idKategorie" => $_POST['kategorie']
    );

    $article->createArticle($articleTableData, $artikelHasKategorieData);


}



/**
 * Artikelkategorien für Dropdown Menü holen
 */
if(isset($_GET['section']) && $_GET['section'] == "Artikel anlegen") {
    $articleCategories = $article->getCategories();
}