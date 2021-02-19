<?php

namespace A3020\PageReport\View;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class PageTypes implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function view()
    {
        $view = new View('page_types');
        $view->setPackageHandle('page_report');

        $view->addScopeItems([
            'pageTypes' => $this->app->make(\A3020\PageReport\Statistics\PageTypes::class)->get(),
        ]);

        return $view->render();
    }
}
