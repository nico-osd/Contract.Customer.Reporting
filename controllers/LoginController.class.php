<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 28.05.14
 * Time: 23:02
 */

namespace controllers;

use entities\CheckLogin;
use entities\Employee;
use mysqli;
use libs\PasswordHash;


class LoginController
{
    private $checkLogin;
    private $employee;
    private $t_hasher;

    public function __construct(mysqli $mysqli)
    {
        $this->checkLogin = new CheckLogin($mysqli);
        $this->employee = new Employee($mysqli);
        $this->t_hasher = new PasswordHash(8, FALSE);
    }


    public function checkLogin($username, $password)
    {
        $result = $this->checkLogin->checkEmployeeLogin($username);

        while ($row = mysqli_fetch_assoc($result)) {
            if ($this->t_hasher->CheckPassword($password, $row['password']))
                return true;
        }

        return false;
    }

    public function setSessionDetails($username)
    {
        $result = $this->employee->getDetailsByEmployee($username);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $username;
            $_SESSION['nachname'] = $row['nachname'];
            $_SESSION['vorname'] = $row['vorname'];
            $_SESSION['rolle'] = $row['abteilung'];
            $_SESSION['telefonnummer'] = $row['telefonnummer'];
            $_SESSION['id'] = $row['idMitarbeiter'];
            return true;
        }
        return false;
    }
}