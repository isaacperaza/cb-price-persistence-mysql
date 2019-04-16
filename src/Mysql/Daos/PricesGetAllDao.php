<?php

namespace Cb\PricePersistence\Mysql\Daos;

use Cb\PricePersistence\Mysql\DatabaseInterface;
use Cb\PricePersistenceContracts\Daos\PricesGetAllDaoInterface;
use Cb\PricePersistenceContracts\Models\Price;
use Exception;
use PDO;

/**
 * Dao to fetch all available prices from mysql database
 * @package Cb\PricePersistence\Mysql\Daos
 */
class PricesGetAllDao implements PricesGetAllDaoInterface
{
    /** @var DatabaseInterface */
    private $database;

    /**
     * @param DatabaseInterface $database
     */
    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * @return Price[]
     */
    public function getAll()
    {
        try {
            $pdo = $this->database->getConnection();
            $statement = <<<SQL
SELECT id, start_date as startDate, end_date as endDate, price FROM prices;
SQL;
            $query = $pdo->query($statement);
            return $query->fetchAll(PDO::FETCH_CLASS, Price::class);
        } catch (Exception $exception) {
            // TODO: log exception and throw Persistence exception
        }
    }
}
