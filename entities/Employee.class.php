<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 21.01.14
 * Time: 16:24
 */

namespace CCR\entities;

class Employee extends BaseEntity {

    /**
     * Erzeugt einen Query um die Attribute eines Mitarbeiters abzufragen.
     * Ein Mitarbeiter wird durch seinen usernamen identifiziert. Es wird
     * das Resultat zureuckgegeben.
     *
     * @param string $username Username des Mitarbeiters
     * @return mixed Entweder ein array mit daten oder ein leerer array falls nichts gefunden wurde
     */
    public function getDetailsByEmployee($username) {
        //SQL statement
        $stmt = "SELECT username, nachname, vorname, abteilung, idMitarbeiter, telefonnummer FROM mitarbeiter
        WHERE username = :username";

        //Data for select query
        $data = array(
            "username" => $username
        );

        //Return selected data
        return $this->db->select($stmt, $data);
    }

    /**
     * Selektiert das Passwort des angegebenen Benutzers und
     * returned ein array
     *
     * @param string $username Username des Mitarbeiters
     * @return mixed Entweder ein array mit daten oder ein leerer array falls nichts gefunden wurde
     */
    public function getPasswordByEmployee($username) {
        //SQL statement
        $stmt = "SELECT password FROM mitarbeiter WHERE username = :username";

        //Data for select query
        $data = array(
            "username" => $username
        );

        //Return selected data
        return $this->db->select($stmt, $data);
    }
}