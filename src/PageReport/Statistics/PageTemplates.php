<?php

namespace A3020\PageReport\Statistics;

use A3020\PageReport\Result\PageTemplateResult;
use Concrete\Core\Database\Connection\Connection;

class PageTemplates
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
     * Get a list of page templates and how many pages each template has
     *
     * @return PageTemplateResult[]
     */
    public function get()
    {
        $results = [];
        foreach ($this->getResults() as $result) {
            $results[] = new PageTemplateResult(
                $result['pTemplateID'],
                $result['pTemplateHandle'],
                $result['pTemplateName'],
                $result['numberOfPages']
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll('
            SELECT cv.pTemplateID, pt.pTemplateHandle, pt.pTemplateName, COUNT(1) AS numberOfPages FROM (
                SELECT cv.cID, MAX(cv.cvID) AS cvID FROM CollectionVersions AS cv
                INNER JOIN Pages AS p ON p.cID = cv.cID
                WHERE p.cIsSystemPage = 0 AND p.cIsActive = 1 AND p.uID > 0
                GROUP BY cv.cID
            ) tmp
            INNER JOIN CollectionVersions AS cv ON cv.cID = tmp.cID AND cv.cvID = tmp.cvID
            INNER JOIN PageTemplates AS pt ON pt.pTemplateID = cv.pTemplateID
            WHERE cv.cvIsApproved = 1
            GROUP BY cv.pTemplateID, pt.pTemplateHandle, pt.pTemplateName
            ORDER BY numberOfPages DESC
      ');
    }
}
