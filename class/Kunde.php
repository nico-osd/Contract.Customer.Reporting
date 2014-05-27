<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kunde
 *
 * @author project:ocrm
 * @author Christoph Kappel <kappel.christoph@gmail.com>
 * @author Manuel Lindner <manu.lindner92@gmail.com>
 */
class Kunde extends Person{
    //put your code here
    private $adress;
    private $town;
    private $birthDate;
    
    
    function setTown($town){
        $this->town=$town;
    }
    
}

?>
