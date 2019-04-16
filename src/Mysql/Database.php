<?php

namespace Cb\PricePersistence\Mysql;

use PDO;
use PDOException;

/**
 * Class Database
 * @package Cb\PricePersistence\Mysql
 */
class Database implements DatabaseInterface
{
    /** @var PDO */
    private $connection;
    
    /** @var Database */
    private static $instance;

    private function __construct()
    {
        $this->createConnection();
    }

    private function __clone()
    {
    }

    /**
     * Get an instance of the Database
     * @return Database
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return mixed
     */
    private function createConnection()
    {
        $host = getenv('DB_HOST');
        $databaseName = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $dsn = 'mysql:dbname=' . $databaseName . ';host=' . $host;
        
        try {
            $this->connection = new PDO($dsn, $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // TODO: log exception and throw application exception
        }
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
