<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 28.05.14
 * Time: 23:02
 */

namespace CCR\controllers;

use CCR\entities\CheckLogin;
use CCR\entities\Employee;
use CCR\libs\PasswordHash;
use CCR\libs\Session;


class LoginController
{
    private $employee;
    private $t_hasher;

    public function __construct()
    {
        $this->employee = new Employee();
        $this->t_hasher = new PasswordHash(8, FALSE);
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function checkLogin($username, $password)
    {
        $result = $this->employee->getPasswordByEmployee($username);

        if(!empty($result)) {
            if($this->t_hasher->CheckPassword($password, $result[0]["password"])) {
                $this->setSessionDetails($username);
                return true;
            }
        }

        return false;
    }

    private function setSessionDetails($username)
    {
        //Employee data
        $result = $this->employee->getDetailsByEmployee($username);

        //Session data festlegen
        $sessionData = array(
            "username" => $username,
            "nachname" => $result[0]["nachname"],
            "vorname" => $result[0]["vorname"],
            "rolle" => $result[0]["abteilung"],
            "telefonnummer" => $result[0]["telefonnummer"],
            "id" => $result[0]["idMitarbeiter"]
        );

        //Session data setzen
        Session::setMultiple($sessionData);

    }
}