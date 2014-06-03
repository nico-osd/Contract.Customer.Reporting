<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 03.06.14
 * Time: 10:25
 */

namespace CCR\libs;


class Cookie {

    /**
     * Setzt ein Cookie mit den Breadcrumb Daten
     *
     * @param array $data Daten die in das Cookie gespeichert werden
     */
    public static function setBreadcrumbCookie($data = array()) {
        $content = "<a href='index.php'>CCR</a>";

        //$content .= implode(" | ", $data);


        for($i = 0; $i < sizeof($data); $i++) {
            $content .= " | <a href='index.php?section=" . $data[$i] . "'>" . $data[$i] ."</a>";
        }


        setcookie("breadcrumb", $content);
    }


} 