<?php

namespace A3020\PageReport\View\Chart;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class PagesCreated implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function view()
    {
        $view = new View('chart/pages_created');
        $view->setPackageHandle('page_report');

        $results = $this->app->make(\A3020\PageReport\Statistics\PagesCreated::class)->get();

        $view->addScopeItems([
            'results' => $results,
            'data' => $this->getData($results),
        ]);

        return $view->render();
    }

    /**
     * @param \A3020\PageReport\Result\PagesCreatedResult[] $results
     *
     * @return array
     */
    private function getData(array $results)
    {
        $data = [];
        foreach ($results as $result) {
            $data[] = [
                'year' => $result->getYear(),
                'month' => $result->getMonth(),
                'pages' => $result->getNumberOfPages(),
            ];
        }

        return $data;
    }
}
