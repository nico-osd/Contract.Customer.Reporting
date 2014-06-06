<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 05.06.14
 * Time: 18:47
 */

namespace CCR\libs;


class CheckRequestMethod {

    /**
     * Überprüft ob POST Parameter gesetzt ist und einen Wert zutrifft => Assoziativer Array
     * Falls value von array leer ist, ist dieser auch gültig
     *
     * @param array $data Assoziativer Array, Bsp "section" => "Artikel suchen", "action" => "delete", ...
     * @return bool
     */
    public static function issetPOST($data = array()){
        foreach($data as $key => $value) {
            if(!isset($_POST[$key])) {
                return false;
            }
            else {
                if(($value != "" && $_POST[$key] != $value)) {

                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Überprüft ob GET Parameter gesetzt ist und einen Wert zutrifft => Assoziativer Array
     * Falls value von array leer ist, ist dieser auch gültig
     *
     * @param array $data Assoziativer Array, Bsp "section" => "Artikel suchen", "action" => "delete", ...
     * @return bool
     */
    public static function issetGET($data = array()) {
        foreach($data as $key => $value) {
            if(!isset($_GET[$key])) {
                return false;
            }
            else {
                if(($value != "" && $_GET[$key] != $value)) {

                    return false;
                }
            }
        }

        return true;
    }

}