<?php

namespace A3020\PageReport\View\Chart;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class PagesByAuthor implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    protected $pieChunks = 10;

    public function view()
    {
        $view = new View('chart/pages_by_author');
        $view->setPackageHandle('page_report');

        $results = $this->app->make(\A3020\PageReport\Statistics\PagesByAuthor::class)->get($this->pieChunks);

        $view->addScopeItems([
            'results' => $results,
            'labels' => $this->getLabels($results),
            'data' => $this->getData($results),
        ]);

        return $view->render();
    }

    /**
     * @param \A3020\PageReport\Result\PagesByAuthorResult[] $results
     *
     * @return array
     */
    private function getLabels(array $results)
    {
        $labels = [];
        foreach ($results as $result) {
            $labels[] = $result->getAuthor();
        }

        return $labels;
    }

    /**
     * @param \A3020\PageReport\Result\PagesByAuthorResult[] $results
     *
     * @return array
     */
    private function getData(array $results)
    {
        $data = [];
        foreach ($results as $result) {
            $data[] = $result->getNumberOfPages();
        }

        return $data;
    }
}
