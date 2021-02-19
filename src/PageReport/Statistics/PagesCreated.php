<?php

namespace A3020\PageReport\Statistics;

use A3020\PageReport\Result\PagesCreatedResult;
use Concrete\Core\Database\Connection\Connection;

class PagesCreated
{
    /** @var Connection */
    private $db;

    /**
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function get()
    {
        $results = [];
        foreach ($this->getResults() as $result) {
            $results[] = new PagesCreatedResult(
                $result['numberOfPages'],
                $result['addedYear'],
                $result['addedMonth']
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll("
            SELECT DATE_FORMAT(c.cDateAdded, '%Y') as addedYear, DATE_FORMAT(c.cDateAdded, '%m') as addedMonth, COUNT(1) as numberOfPages FROM Collections c
            INNER JOIN Pages p ON p.cID = c.cID
            WHERE p.cIsSystemPage = 0 AND p.cIsActive = 1
            GROUP BY YEAR(c.cDateAdded), MONTH(c.cDateAdded)
        ");
    }
}
