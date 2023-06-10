<?php
declare(strict_types=1);

namespace ManhattanReview\Tenzing\Controller;

use ManhattanReview\Tenzing\Storage\Database;
use Doctrine\DBAL\Connection;

class FlashCardController
{
    private Connection $connection;

    /**
     * Constructor
     */
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    /**
     * Example action returns the data of a flash card
     */
    public function example(string $pathInfo): ?string
    {
        // Get the flash card for this request based on the request path
        $flashCard = $this->getFlashCard($pathInfo);

        if (count($flashCard) > 0) {
            // Extract the data for this flash card
            $flashCardData = $this->getFlashCardData($flashCard);
            // Return a specific data set (e.g. "foobar")
            return $flashCardData->foobar;
        }
        return null;
    }

    /**
     * Read flash card data from the database
     */
    private function getFlashCard(string $pathInfo): array
    {
        // Use the Query Builder instead of writing raw SQL statements
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('id', 'name', 'data')
            ->from('example')
            ->where('slug = ?')
            ->setParameter(0, $pathInfo);

        $result = $queryBuilder->execute()->fetch();
        return $result ?: [];
    }

    /**
     * Returns the data from a flash card as an object
     */
    private function getFlashCardData(array $flashCard): \stdClass
    {
        // @TODO: implement error handling if data stored in the DB is invalid or empty
        return json_decode($flashCard['data']);
    }
}
