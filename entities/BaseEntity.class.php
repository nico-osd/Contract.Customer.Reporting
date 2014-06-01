<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 01.06.14
 * Time: 10:54
 */

namespace entities;
use libs\Database;

class BaseEntity extends Database {

    public function __construct($link) {
       parent::__construct($link);
    }
} 