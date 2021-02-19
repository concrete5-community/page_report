<?php

namespace A3020\PageReport\Statistics;

use A3020\PageReport\Result\UnapprovedPage;
use Concrete\Core\Database\Connection\Connection;

class UnapprovedPages
{
    /**
     * @var Connection
     */
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function get($limit = 200)
    {
        $results = [];
        foreach ($this->getResults($limit) as $result) {
            $results[] = new UnapprovedPage($result['cID'], $result['name'], $result['cDateModified']);
        }

        return $results;
    }
    
    /**
     * Get a list of the biggest images (in dimensions)
     *
     * @param int $limit
     *
     * @return \A3020\PageReport\Result\BigImage[]
     */
    public function getResults($limit)
    {
        return $this->db->fetchAll("
            SELECT cv.cID, cv.cvName AS name, c.cDateModified FROM (
                SELECT cv.cID, MAX(cv.cvID) AS cvID FROM CollectionVersions AS cv
                INNER JOIN Pages AS p ON p.cID = cv.cID
                WHERE p.cIsSystemPage = 0 AND p.cIsActive = 1 AND p.uID > 0
                GROUP BY cv.cID
            ) tmp
            INNER JOIN CollectionVersions AS cv ON cv.cID = tmp.cID AND cv.cvID = tmp.cvID 
            INNER JOIN Collections AS c ON c.cID = cv.cID
            WHERE cv.cvIsApproved = 0
            LIMIT 0, ".$limit
        );
    }
}
