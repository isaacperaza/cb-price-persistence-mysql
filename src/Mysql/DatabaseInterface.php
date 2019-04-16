<?php

namespace Cb\PricePersistence\Mysql;

use PDO;

/**
 * Interface DatabaseInterface
 * @package Cb\PricePersistence\Mysql
 */
interface DatabaseInterface
{
    /**
     * @return Database
     */
    public static function getInstance();

    /**
     * @return PDO
     */
    public function getConnection();
}
