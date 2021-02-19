<?php

namespace A3020\PageReport\View;

use A3020\PageReport\Statistics\General;
use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\View\View;

class GeneralStatistics implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    /** @var Connection */
    private $db;

    /** @var General */
    private $statistics;

    /**
     * @param Connection $db
     * @param General $statistics
     */
    public function __construct(Connection $db, General $statistics)
    {
        $this->db = $db;
        $this->statistics = $statistics;
    }

    public function view()
    {
        $view = new View('general_statistics');
        $view->setPackageHandle('page_report');

        $view->addScopeItems([
            'totalPages' => $this->statistics->getTotalPages(),
            'totalApproved' => $this->statistics->getTotalApproved(),
            'totalUnapproved' => $this->statistics->getTotalUnapproved(),
            'totalInTrash' => $this->statistics->getTotalInTrash(),
            'totalInDraft' => $this->statistics->getTotalInDraft(),
            'totalPageTypes' => $this->statistics->getTotalPageTypes(),
            'totalPageTemplates' => $this->statistics->getTotalPageTemplates(),
        ]);

        return $view->render();
    }
}
