<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11.01.14
 * Time: 12:11
 */

namespace entities;
use mysqli;

class CheckLogin extends BaseEntity
{
    /**
     * Erzeugt ein neues CheckLogin Objekt mit der
     * angegebenen Datenbankverbindung.
     *
     * @param mysqli $link Datenbankverbindung
     */
    public function __construct(mysqli $link)
    {
        parent::__construct($link);
    }

    /**
     * Selektiert das Passwort des angegebenen Benutzers und
     * returned ein mysqli_result, falls ein Passwort zu dem
     * Benutzer gefunden wurde.
     *
     * @param $username benutzername des Mitarbeiters
     * @return bool|mysqli_result false wenn der Query fehlschlaegt
     * mysqli_result wenn der Query erfolgreich ausgefuehrt wird.
     */
    public function checkEmployeeLogin($username)
    {
        // Erzeugen des Mysql Queries
        $query = $this->getLoginEmployeeQuery();

        // Erzeugen eines neuen Stmt Objekts
        // http://at1.php.net/manual/en/class.mysqli-stmt.php
        // Siehe Klasse Database
        $stmt = $this->getStmt($query);

        // Bindet den Username Parameter (s = string) in das Statement.
        // In dem Query wird das ? durch den Usernamen ersetzt.
        $stmt->bind_param('s', $username);

        // ausfuehren des Queries mit Resultset
        // siehe Klasse Database
        $success = $this->executeWithResultSet($stmt);

        // falls keine Datenbankverbindung besteht ist
        // der return wert = null
        if ($success == null) {
            // Falls Debug in Database = true gesetzt ist
            if (parent::$DEBUG)
                // wird eine Debug Mitteilung ausgegeben
                echo '(checkUserLogin) Login was not successful.';
            // false zurueckgegeben = Miserfolg
            return false;
        }

        // das Resultat wird zurueckgegeben (mysqli_result)
        return $success;
    }

    /**
     * Gibt das Query fuer die Selektion des
     * Passworts des angegeben Mitarbeiters zurueck.
     *
     * @return string Query fuer die selektion des Passworts
     */
    public function getLoginEmployeeQuery()
    {
        return 'SELECT password FROM mitarbeiter WHERE username = ?';
    }
}