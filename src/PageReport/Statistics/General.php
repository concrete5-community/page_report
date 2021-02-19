<?php

namespace A3020\PageReport\Statistics;

use Concrete\Core\Config\Repository\Repository;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\PageList;

class General
{
    /**
     * @var Connection
     */
    private $db;

    /**
     * @var Repository
     */
    private $config;

    public function __construct(Connection $db, Repository $config)
    {
        $this->db = $db;
        $this->config = $config;
    }

    /**
     * Number of pages.
     *
     * - Approved or not approved.
     * - Dashboard pages are excluded.
     *
     * @return int
     */
    public function getTotalPages()
    {
        $pl = new PageList();
        $pl->ignorePermissions();

        return (int) $pl->getTotalResults();
    }

    /**
     * Return number of approved pages
     *
     * - Exclude system pages
     *
     * @return int bytes
     */
    public function getTotalApproved()
    {
        return (int) $this->db->fetchColumn('
            SELECT COUNT(1) FROM (
                SELECT cv.cID, MAX(cv.cvID) AS cvID FROM CollectionVersions AS cv
                INNER JOIN Pages AS p ON p.cID = cv.cID
                WHERE p.cIsSystemPage = 0 AND p.cIsActive = 1 AND p.uID > 0
                GROUP BY cv.cID
            ) tmp
            INNER JOIN CollectionVersions AS cv ON cv.cID = tmp.cID AND cv.cvID = tmp.cvID
            WHERE cv.cvIsApproved = 1
        ');
    }

    /**
     * Return number of unapproved pages
     *
     * - Exclude system pages
     *
     * @return int
     */
    public function getTotalUnapproved()
    {
        return (int) $this->db->fetchColumn('
            SELECT COUNT(1) FROM (
                SELECT cv.cID, MAX(cv.cvID) AS cvID FROM CollectionVersions AS cv
                INNER JOIN Pages AS p ON p.cID = cv.cID
                WHERE p.cIsSystemPage = 0 AND p.cIsActive = 1 AND p.uID > 0
                GROUP BY cv.cID
            ) tmp
            INNER JOIN CollectionVersions AS cv ON cv.cID = tmp.cID AND cv.cvID = tmp.cvID
            WHERE cv.cvIsApproved = 0
        ');
    }

    /**
     * Return number pages that are in the trash
     *
     * @return int
     */
    public function getTotalInTrash()
    {
        $total = 0;

        $trash = Page::getByPath($this->config->get('concrete.paths.trash'));
        if ($trash && !$trash->isError()) {
            $total = $this->db->fetchColumn("
                SELECT COUNT(1) FROM Pages AS p 
                INNER JOIN PagePaths AS pp ON pp.cID = p.cID
                WHERE p.cIsActive = 0 AND pp.cPath LIKE '" . $trash->getCollectionPath() . "%'
            ");
        }

        return (int) $total;
    }

    /**
     * Return number pages that are in drafts
     *
     * @return int
     */
    public function getTotalInDraft()
    {
        $total = 0;

        $drafts = Page::getByPath($this->config->get('concrete.paths.drafts'));
        if ($drafts && !$drafts->isError()) {
            $total = $this->db->fetchColumn("
                SELECT COUNT(1) FROM Pages 
                INNER JOIN Collections c ON Pages.cID = c.cID 
                WHERE cParentID = ? 
                ORDER BY cDateAdded DESC", [
                $drafts->getCollectionID(),
            ]);
        }

        return (int) $total;
    }

    /**
     * Return number of page types
     *
     * @return int
     */
    public function getTotalPageTypes()
    {
        return (int) $this->db->fetchColumn('SELECT COUNT(1) FROM PageTypes WHERE ptIsInternal = 0');
    }

    /**
     * Return number of page types
     *
     * @return int
     */
    public function getTotalPageTemplates()
    {
        return (int) $this->db->fetchColumn('SELECT COUNT(1) FROM PageTemplates WHERE pTemplateIsInternal = 0');
    }
}
