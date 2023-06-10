<?php
declare(strict_types=1);

namespace ManhattanReview\Tenzing\Storage;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;

class Database
{
    private Connection $connection;

    /**
     * Constructor
     */
    public function __construct()
    {
        // The connection details can differ depending on the used driver.
        // https://www.doctrine-project.org/projects/doctrine-dbal/en/current/reference/configuration.html#pdo-mysql
        $connectionParams = [
            'dbname' => $_ENV['DATABASE_DBNAME'],
            'user' => $_ENV['DATABASE_USER'],
            'password' => $_ENV['DATABASE_PASSWORD'],
            'host' => $_ENV['DATABASE_HOST'],
            'driver' => $_ENV['DATABASE_DRIVER']
        ];

        // The DriverManager returns an instance of Doctrine\DBAL\Connection
        // which is a wrapper around the underlying driver connection
        $this->connection = DriverManager::getConnection($connectionParams);
    }

    /**
     * Returns the database connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }
}
