<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11.01.14
 * Time: 12:11
 */

class CheckLogin extends Database
{

    public function __construct($link)
    {
        parent::__construct($link);
    }

    public function checkEmployeeLogin($nachname, $password)
    {
        $query = $this->getLoginEmployeeQuery();

        $stmt = $this->getStmt($query);

        $stmt->bind_param('ss', $nachname, $password);

        $success = $this->executeWithResultSet($stmt);

        if (($success == null) || !mysqli_num_rows($success) == 1) {
            if (self::$DEBUG)
                echo '(checkEmployeeLogin) Login was not successful';
            return false;
        } else
            return true;
    }

    public function getLoginEmployeeQuery()
    {
        return 'SELECT * FROM mitarbeiter WHERE nachname = ? AND password = ?';
    }

}