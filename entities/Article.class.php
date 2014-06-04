<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 03.06.14
 * Time: 22:08
 */

namespace CCR\entities;


class Article extends BaseEntity {

    public function getCategoryNames() {
        $stmt = "SELECT * FROM kategorie";

        return $this->db->select($stmt);
    }



    public function insert($articleTableData, $artikelHasKategorieData) {
        $artikelHasKategorieData['Artikel_idArtikel'] = $this->db->getLastIDFromTable("artikel");

        $this->db->insert("artikel", $articleTableData);
        $this->db->insert("artikel_has_kategorie", $artikelHasKategorieData);

    }

} 