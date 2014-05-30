<?php
namespace entities;
use mysqli;
use mysqli_stmt;

/**
 * Created by PhpStorm.
 * User: Nico Henglmueller
 * Date: 17.12.13
 * Time: 17:27
 */
class Database {
    /**
     * @var bool Debug Flag um Abgfragen zu debuggen
     * NICHT UEBERSCHREIBEN !
     */
    public static $DEBUG = FALSE;

    /**
     * @var mysqli Referenz zur Datenbank
     */
    private $mysqli;

    /**
     * Erzeugt ein neues Database Objekt mit der uebergebenen
     * mysqli Referenz.
     *
     * @param mysqli $link der Link zur Datenbank (mysqli Objekt)
     */
    public function __construct(mysqli $link)
    {
        $this->mysqli = $link;
    }

    /**
     * Erzeugt ein neues Statement Objekt aus
     * dem uebergebenen Query und gibt dies zurueck.
     *
     * @param $query ein Query (SELECT * FROM X WHERE y = ?)
     * @return mysqli_stmt ein neues stmt Objekt
     */
    public function getStmt($query)
    {
        $stmt = $this->mysqli->prepare($query);
        if ($stmt == false)
            die('prepare() failed: ' . htmlspecialchars($this->mysqli->error));

        return $stmt;
    }

    /**
     * Fuehrt das uebergebene Query aus und gibt ein resultset zurueck.
     * Nuetzlich bei select Queries um ueber das result zu iterieren.
     *
     * @link http://www.php.net/manual/en/class.mysqli-result.php
     * @param mysqli_stmt $stmt
     * @return bool|mysqli_result
     */
    function executeWithResultSet(mysqli_stmt $stmt)
    {
        $stmt->execute();
        $success = $stmt->get_result();

        if (!$success)
            die('mysqli_stmt_get_result failed: ' . htmlspecialchars($this->mysqli->error));


        $stmt->fetch();
        $stmt->close();

        return $success;
    }

    /**
     * Fuehrt das angegebene Query aus und gibt den
     * Erfolg bzw. Miserfolg zurueck
     * (TRUE = Erfolg, FALSE = Miserfolg)
     *
     * @link http://php.net/manual/en/mysqli-stmt.execute.php
     * @param mysqli_stmt $stmt das auszufuehrende Statement
     * @return bool true wenn das Query erfolgreich ausgefuehrt wurde
     *         false wenn das Query nicht erfolgreich war.
     */
    function execute(mysqli_stmt $stmt)
    {
        $result = $stmt->execute();
        if (!$result)
            die('mysqli_stmt_execute failed: ' . mysqli_error($this->mysqli));
        $stmt->fetch();
        $stmt->close();

        return $result;
    }

    /**
     * Gibt die zuletzt generierte ID zurueck.
     *
     * @return mixed die zuletzt generierte id.
     */
    function getLastGeneratedId()
    {
        return $this->mysqli->insert_id;
    }
}