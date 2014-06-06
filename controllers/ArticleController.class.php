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

    public function delete($id){
        $this->article->delete($id);
    }

} 