<?php
namespace controller;

require $_SERVER['DOCUMENT_ROOT'] . "/Contract.Customer.Reporting/entities/CheckLogin.class.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Contract.Customer.Reporting/entities/Employee.class.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Contract.Customer.Reporting/inc/PasswordHash.php";

use entities\CheckLogin;
use entities\Employee;
use mysqli;
use util\PasswordHash;
use mysqli_result;

/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 28.05.14
 * Time: 23:02
 */

class LoginControll
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