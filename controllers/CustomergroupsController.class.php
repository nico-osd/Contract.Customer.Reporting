<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 02.06.14
 * Time: 22:20
 */

namespace CCR\controllers;

use CCR\entities\Customergroups;

class CustomergroupsController
{

    private $customergroups;

    public function __construct()
    {
        $this->customergroups = new Customergroups();
    }

    public function getAllCustomerGroupsNames()
    {
        return $this->customergroups->getCustomergroupsIDsNames();
    }


} 