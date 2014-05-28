<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 21.01.14
 * Time: 16:24
 */

class Employee extends Database
{

    public function __construct(mysqli $link)
    {
        parent::__construct($link);
    }

    function getGetDetailsByEmployee($nachname)
    {

        $query = $this->getGetAllOrdersByCustomerQuery();

        $stmt = $this->getStmt($query);

        $result = $this->executeWithResultSet($stmt);

        if (!$result) {
            if (parent::$DEBUG) {
                echo '<br/>CarAction.<strong>(createNewOrder):<strong> could not create order';
            }
            return false;
        }

        return $result;
    }

    function getOrderDetails($oid)
    {
        $query = $this->getOrderDetailsByIdQuery();

        $stmt = $this->getStmt($query);

        $stmt->bind_param('i', $oid);

        $result = $this->executeWithResultSet($stmt);

        if (!$result) {
            if (parent::$DEBUG) {
                echo '<br/>CarAction.<strong>(createNewOrder):<strong> could not create order';
            }
            return false;
        }

        return $result;
    }

    function updateOrderStatus($oid, $status)
    {

        $query = $this->getUpdateOrderStatusQuery();

        $stmt = $this->getStmt($query);

        $stmt->bind_param('si', $status, $oid);

        $result = $this->execute($stmt);

        if (!$result) {
            if (parent::$DEBUG) {
                echo '<br/>CarAction.<strong>(createNewOrder):<strong> could not create order';
            }
            return false;
        }

        return true;
    }

    function getOrderDetailsByIdQuery()
    {
        return 'SELECT idOrder, `status`, price, `name`, fellycol, carcol, cus.firstname, cus.lastname, cus.email, a.street, a.city, a.plz FROM `order` o INNER JOIN `car` c ON o.idOrder = c.Order_idOrder INNER JOIN `customer` cus  ON o.Customer_idCustomer = cus.idCustomer INNER JOIN `adress` a ON cus.Adress_idAdress = a.idAdress WHERE o.idOrder = ?;';
    }

    function getGetAllOrdersByCustomerQuery()
    {
        return 'SELECT * FROM mitarbeiter WHERE nach';
    }

    function getUpdateOrderStatusQuery()
    {
        return 'UPDATE `order` SET status = ? WHERE idOrder = ?';
    }

} 