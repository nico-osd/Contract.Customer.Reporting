<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 02.06.14
 * Time: 22:16
 */

namespace CCR\entities;

class Customergroups extends BaseEntity
{


    /**
     * Returns the names of all customergroups.
     *
     * @return array|mixed result
     */
    public function getCustomergroupsIDsNames()
    {
        $stmt = $this->getCustomerGroupsIDsNamesQuery();

        return $this->db->select($stmt);
    }

    /**
     * Returns a query for selecting the names of all groups of Customers.
     *
     * @return string the query
     */
    private function getCustomerGroupsIDsNamesQuery()
    {
        return "SELECT idKundengruppe, name FROM kundengruppe";
    }

} 