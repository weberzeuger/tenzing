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
    }

    /**
     * Example action returns the data of a flash card
     */
    public function example(string $pathInfo): ?string
    {
        //var_dump($pathInfo);
        // Get the flash card for this request based on the request path
        $flashCard = $this->getFlashCard($pathInfo);

        // Example: Read data from a different database cluster
        $school = $this->getMadmissSchool();

        if (count($flashCard) > 0) {
            // Extract the data for this flash card
            $flashCardData = $this->getFlashCardData($flashCard);
            // Return a specific data set (e.g. "foobar")
            return $flashCardData->foobar;
        }
        //return null;
        return "[FLASHCARD CONTENT]";
    }

    /**
     * Read flash card data from the database
     */
    private function getFlashCard(string $pathInfo): array
    {
        $database = new Database();
        $this->connection = $database->getConnection('tenzing');

        // Use the Query Builder instead of writing raw SQL statements
        $queryBuilder = $this->connection->createQueryBuilder();
        //var_dump($queryBuilder);
        
        $queryBuilder
            ->select('id', 'name', 'data')
            ->from('example')
            ->where('slug = ?')
            ->setParameter(0, $pathInfo);
                
        $result = $queryBuilder->execute()->fetch();
        return $result ?: [];
    }

    /**
     * Read from the "ma_school" tables of the "manhattanreview_madmiss" database
     */
    private function getMadmissSchool(): array
    {
        $database = new Database();
        $this->connection = $database->getConnection('madmiss');
        $queryBuilder = $this->connection->createQueryBuilder();
        
        $queryBuilder
            ->select('school_label')
            ->from('ma_schools')
            ->where('school_group = :country')
            ->setParameter('country', 'Switzerland');
                
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
