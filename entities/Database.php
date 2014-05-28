<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 17.12.13
 * Time: 17:27
 */

// create new Adress

class Database
{
    public static $DEBUG = false;

    private $mysqli;

    public function __construct(mysqli $link)
    {
        $this->mysqli = $link;
    }

    public function getStmt($query)
    {
        return mysqli_prepare($this->mysqli, $query);
    }

    function executeWithResultSet($stmt)
    {
        mysqli_stmt_execute($stmt);
        //mysqli_stmt_bind_result($stmt, $success);
        $success = mysqli_stmt_get_result($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $success;
    }

    function execute($stmt)
    {
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    function getLastGeneratedId()
    {
        return mysqli_insert_id($this->mysqli);
    }
}