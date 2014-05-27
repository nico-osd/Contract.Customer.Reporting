<?php

/**
 * Description of Person
 *
 * @author project:ocrm
 * @author Christoph Kappel <kappel.christoph@gmail.com>
 * @author Manuel Lindner <manu.lindner92@gmail.com>
 */
class Person {

    //put your code here

    private $firstName;
    private $lastName;
    private $ID;
    
    function Person($fn,$ln){
        $this->firstName=$fn;
        $this->lastName=$ln;
        
    }
    /**
     * returns LastName of OBJECT Person
     * @return String
     */
    function getLastName() {
        return $this->lastName;
    }

    /**
     * returns FirstName of OBJECT Person
     * @return String
     */
    function getFirstName() {
        return $this->firstName;
    }
    /**
     * sets Lastname of OBJECT Person
     * @param type $fn
     */
    function setLastName($ln) {
        $this->lastName = $ln;
    }
    /**
     * sets Firstname of OBJECT Person
     * @param type $ln
     */
    function setFirstName($fn) {
        $this->firstName = $fn;
    }

}

?>
