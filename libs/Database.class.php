<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 01.05.14
 * Time: 18:10
 *
 * package libs/
 *
 */

namespace CCR\libs;
use PDO, PDOException;

class Database extends PDO {

    /**
     * Initializes Database connection
     *
     * @param string $DB_TYPE The type of the database, ex: mysqli
     * @param string $DB_HOST The hostname of the database, ex: localhost
     * @param string $DB_NAME The name of the database
     * @param string $DB_USER The username for the database
     * @param string $DB_PASS The password for the database
     */
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {

        try {
            parent::__construct($DB_TYPE . ":host=" . $DB_HOST . ";dbname=" . $DB_NAME . ";charset=utf8", $DB_USER, $DB_PASS);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }

        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Prepared select statement
     *
     * EXAMPLE USAGE:
     * $stmt = "SELECT username, password FROM user WHERE username = :un AND password = :pw";
     * $data = array("un" => "myname", "pw" => "mypassword");
     * $this->db->select($stmt, $data);
     *
     * @param string $sql An SQL statement
     * @param array $array Paramters to bind
     * @param mixed $fetchMode A PDO Fetch mode
     * @return array|mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->prepare($sql);

        foreach($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }

        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }


    /**
     * Prepared insert statement
     *
     * EXAMPLE USAGE:
     * $table = "user";
     * $data = array("username" => "max", "password" => "mustermann");
     * $this->db->insert($table, $data);
     *
     * @param string $table The name of table to insert into
     * @param array $data Associative array -> includes fieldNames and fieldValues to insert
     */
    public function insert($table, $data) {
        ksort($data);

        $fieldNames = implode("`, `", array_keys($data));
        $fieldValues = ":" . implode(", :", array_keys($data));

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`)
            VALUES ($fieldValues)");

        foreach($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }


    /**
     * Prepared update statement
     *
     * EXAMPLE USAGE:
     * $table = "user";
     * $data = array("username" => "max", "password" => "mustermann");
     * $this->db->update($table, $data, "username = my_old_name");
     *
     *
     * @param string $table The name of table to insert into
     * @param array $data associative array
     * @param string $where Where clause in the query, ex: id = ##
     */
    public function update($table, $data, $where) {
        //Not necessary
        ksort($data);

        $fieldDetails = null;
        foreach($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }

        $fieldDetails = rtrim($fieldDetails, ",");

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }


    /**
     * Prepared delete statement
     *
     * EXAMPLE USAGE:
     * $table = "user";
     * $this->db->delete($table, "user_id = 5");
     *
     *
     * @param string $table The name of table to delete from
     * @param string $where Where clause in the query, ex: id = ##
     * @param integer $limit (Optional) Limit the number of deletes, to prevent multiple deletings
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1) {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");

    }

}