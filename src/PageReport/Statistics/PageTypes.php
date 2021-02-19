<?php

namespace A3020\PageReport\Statistics;

use A3020\PageReport\Result\PageTypeResult;
use Concrete\Core\Database\Connection\Connection;

class PageTypes
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

    /**
     * Get a list of page types and how many pages each page type has
     *
     * @return PageTypeResult[]
     */
    public function get()
    {
        $results = [];
        foreach ($this->getResults() as $result) {
            $results[] = new PageTypeResult(
                $result['ptID'],
                $result['ptHandle'],
                $result['ptName'],
                $result['numberOfPages']
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll('
            SELECT p.ptID, pt.ptHandle, pt.ptName, COUNT(1) AS numberOfPages FROM (
                SELECT cv.cID, MAX(cv.cvID) AS cvID FROM CollectionVersions AS cv
                INNER JOIN Pages AS p ON p.cID = cv.cID
                WHERE p.cIsSystemPage = 0 AND p.cIsActive = 1 AND p.uID > 0
                GROUP BY cv.cID
            ) tmp
            INNER JOIN CollectionVersions AS cv ON cv.cID = tmp.cID AND cv.cvID = tmp.cvID
            INNER JOIN Pages AS p ON p.cID = cv.cID
            INNER JOIN PageTypes AS pt ON pt.ptID = p.ptID
            WHERE cv.cvIsApproved = 1
            GROUP BY p.ptID, pt.ptHandle, pt.ptName
            ORDER BY numberOfPages DESC
      ');
    }
}
