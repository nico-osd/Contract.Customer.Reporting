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


    /**
     * Daten in Datenbank einfügen
     *
     * @param array $articleTableData Daten die in die Tabelle Artikel eingefügt werden
     * @param array $artikelHasKategorieData Daten die in die Tabelle Artike_has_Kategorie eingefügt werden
     */
    public function insert($articleTableData, $artikelHasKategorieData) {
        $artikelHasKategorieData['Artikel_idArtikel'] = $this->db->getLastIDFromTable("artikel");

        $this->db->insert("artikel", $articleTableData);
        $this->db->insert("artikel_has_kategorie", $artikelHasKategorieData);

    }

    /**
     * Daten von Datenbank holen
     *
     * @param string $data Suchkriterien
     * @return array|mixed|void
     */
    public function select($data) {
        $stmt = "SELECT idArtikel, bezeichnung, name, einheit, einkaufspreis, nettopreis FROM artikel
            JOIN artikel_has_kategorie ON idArtikel = Artikel_idArtikel
            JOIN kategorie ON Kategorie_idKategorie = idKategorie
            WHERE idArtikel LIKE(:artikelnummer) AND bezeichnung LIKE(:bezeichnung)";

        return $this->db->select($stmt, $data);
    }

    /**
     * Artikel löschen
     *
     * @param string $id ID des Artikels
     * @return int|void
     */
    public function delete($id) {
        $this->db->delete("artikel", "idArtikel = '$id'");
    }


    /**
     * Artikeldaten updaten
     *
     * @param string $data Neue Daten
     * @param integer $articleId Artikel ID
     */
    public function update($data, $articleId) {
        $table = "artikel INNER JOIN artikel_has_kategorie ON idArtikel = Artikel_idArtikel";
        $where = "idArtikel = " . $articleId;

        $this->db->update($table, $data, $where);
    }


    /**
     * Informationen für einen bestimmten Artikel
     *
     * @param integer $dataID ID des Artikels
     * @return array|mixed
     */
    public function singleArticleInfo($dataID) {
        $stmt = "SELECT bezeichnung, name, einheit, einkaufspreis, nettopreis FROM artikel
        JOIN artikel_has_kategorie ON idArtikel = Artikel_idArtikel
        JOIN kategorie ON Kategorie_idKategorie = idKategorie
        WHERE idArtikel = :artikelID";

        return $this->db->select($stmt, $dataID);
    }

} 