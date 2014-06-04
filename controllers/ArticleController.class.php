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


    public function createArticle($articleTableData, $artikelHasKategorieData) {
        $this->article->insert($articleTableData, $artikelHasKategorieData);
    }

    public function searchArticle() {

    }

} 