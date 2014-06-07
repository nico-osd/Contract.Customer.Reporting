<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 03.06.14
 * Time: 22:22
 */

use CCR\controllers\ArticleController;
use CCR\libs\CheckRequestMethod;

// Artikel Controller
$article = new ArticleController();

/**
 * Wird ausgeführt wenn user auf submit Button klickt
 */
if(CheckRequestMethod::issetPOST(array("createArticle" => ""))) {
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
 * Wird ausgeführt wenn User einen artikel löscht
 */
if(CheckRequestMethod::issetGET(array("section" => "Artikel", "action" => "delete", "val" => ""))) {
    $article->delete($_GET['val']);
}



/**
 * Wird ausgeführt wenn ein User einen Artikel sucht, wird aufgerufen durch AJAX Request
 */
if(CheckRequestMethod::issetGET(array("section" => "Artikel suchen", "action" => "search"))) {
    $searchData = array(
        "artikelnummer" => "%" . $_POST['artikelnummer'] . "%",
        "bezeichnung" => "%" . $_POST['bezeichnung'] . "%"
    );

    echo json_encode($article->searchArticle($searchData));
    //Stoppt das nachstehender Inhalt geladen wird, muss verwendet werden
    //sonst ist das Ergebnis für den Ajax Request die ganze HTML Seite
    die;
}



/**
 * Artikelkategorien für Dropdown Menü holen
 */
if(CheckRequestMethod::issetGET(array("section" => "Artikel anlegen"))) {
    $articleCategories = $article->getCategories();
}