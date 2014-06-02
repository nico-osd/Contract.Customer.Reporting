<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 01.06.14
 * Time: 10:54
 */

namespace CCR\entities;

use CCR\libs\Database;

class BaseEntity extends Database {

    protected $db;

    public function __construct() {
       $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }
} 