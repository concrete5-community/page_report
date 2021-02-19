<?php

namespace A3020\PageReport\Statistics;

use A3020\PageReport\Result\PagesUpdatedResult;
use Concrete\Core\Database\Connection\Connection;

class PagesUpdated
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
            $results[] = new PagesUpdatedResult(
                $result['numberOfPages'],
                $result['updatedYear'],
                $result['updatedMonth']
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll("
            SELECT DATE_FORMAT(c.cDateModified, '%Y') as updatedYear, DATE_FORMAT(c.cDateModified, '%m') as updatedMonth, COUNT(1) as numberOfPages FROM Collections c
            INNER JOIN Pages p ON p.cID = c.cID
            WHERE p.cIsSystemPage = 0 AND p.cIsActive = 1
            GROUP BY YEAR(c.cDateModified), MONTH(c.cDateModified)
            ORDER BY c.cDateModified ASC
        ");
    }
}
