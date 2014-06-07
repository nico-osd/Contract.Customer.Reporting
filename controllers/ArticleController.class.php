<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 03.06.14
 * Time: 22:07
 */

namespace CCR\controllers;


use CCR\entities\Article;

class ArticleController {

    private $article;

    public function __construct(){
        $this->article = new Article();
    }

    /**
     * Select Artikel Kategorien
     *
     * @return array|mixed
     */
    public function getCategories(){
        return $this->article->getCategoryNames();
    }

    /**
     * Artikel erstellen
     *
     * @param array $articleTableData Daten für die Tabelle Artikel
     * @param array $artikelHasKategorieData Daten für die Artikel_has_Kategorie
     */
    public function createArticle($articleTableData, $artikelHasKategorieData) {
        $this->article->insert($articleTableData, $artikelHasKategorieData);
    }

    /**
     * Artikel suchen
     *
     * @param array $data Suchkritieren
     * @return array
     */
    public function searchArticle($data) {
        $data = $this->article->select($data);

        $responseArray = array();

        if(empty($data)) {
            $responseArray["status"] = "error";
            $responseArray["answer"] = "Keine Artikel gefunden!";
        }
        else {
            $responseArray["status"] = "success";
            $responseArray["answer"] = $data;
        }

        return $responseArray;
    }


    /**
     * Artikel löschen
     *
     * @param integer $id ID des Artikels
     */
    public function delete($id){
        $this->article->delete($id);
    }

    /**
     * Artikel updaten
     *
     * @param array $data Neue Artikeldaten
     * @param integer $articleId ID des aritkels
     */
    public function editArticle($data, $articleId) {
        $this->article->update($data, $articleId);
    }


    /**
     * Informationen von einem bestimmten Artikel holen
     *
     * @param array $data Artikel ID
     * @return array|mixed
     */
    public function getSingleArticleInfo($data) {
        return $this->article->singleArticleInfo($data);
    }


} 