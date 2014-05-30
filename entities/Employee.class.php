<?php
namespace entities;

use mysqli;
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 21.01.14
 * Time: 16:24
 */
class Employee extends Database
{

    /**
     * Erzeubt eine neue Employee Entity um die Eigenschaften
     * eines Mitarbeiters aus der Datenbank abzufragen.
     *
     * @param mysqli $link Datenbankverbindungsobjekt
     */
    public function __construct(mysqli $link)
    {
        // uebergeben an den Konstruktor in Database
        parent::__construct($link);
    }

    /**
     * Erzeugt einen Query um die Attribute eines Mitarbeiters abzufragen.
     * Ein Mitarbeiter wird durch seinen usernamen identifiziert. Es wird
     * das Resultat oder False zureuckgegeben.
     *
     * @param $username username des Mitarbeiters
     * @return bool|mysqli_result false falls der Query fehlgeschlagen ist
     *         mysqli_result wenn der Query erfolgreich ausgefuehrt wurde.
     */
    function getDetailsByEmployee($username)
    {

        $query = $this->getDetailsByEmployeeQuery();

        $stmt = $this->getStmt($query);

        $stmt->bind_param('s', $username);

        $result = $this->executeWithResultSet($stmt);

        if (!$result) {
            if (parent::$DEBUG) {
                echo '<br/>Employee.<strong>(getDetailsByEmployee):<strong> could select information.';
            }
            return false;
        }

        return $result;
    }

    /**
     * Gibt den Query fuer die Datenbankabfrage der Daten eines bestimmten
     * (durch den Usernamen identifizierten) Mitarbeiter zurueck.
     *
     * @return string der SELECT Query fuer den Mitarbeiter.
     */
    function getDetailsByEmployeeQuery()
    {
        return 'SELECT username, nachname, vorname, abteilung, idMitarbeiter, telefonnummer  FROM mitarbeiter WHERE username = ?';
    }
}