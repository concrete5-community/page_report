<?php

namespace A3020\PageReport\Statistics;

use A3020\PageReport\Result\PagesByAuthorResult;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\User\User;

class PagesByAuthor
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

    public function get($limit = 10)
    {
        $remaining = 0;
        $i = 0;
        $results = [];
        foreach ($this->getResults() as $result) {
            if ($i > $limit) {
                $remaining += $result['numberOfPages'];
            } else {
                $user = User::getByUserID($result['author']);
                if (!$user) {
                    continue;
                }

                $results[] = new PagesByAuthorResult(
                    $user->getUserName(),
                    $result['numberOfPages']
                );
            }

            $i++;
        }

        if ($remaining) {
            $results[] = new PagesByAuthorResult(
                t('Others'),
                $remaining
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll('
            SELECT cvAuthorUID as author, COUNT(1) as numberOfPages FROM CollectionVersions cv
            INNER JOIN Pages p ON p.cID = cv.cID
            WHERE cv.cvID = 1 AND p.cIsSystemPage = 0 AND cv.cvAuthorUID != 0
            GROUP BY cv.cvAuthorUID
            ORDER BY numberOfPages DESC
        ');
    }
}
