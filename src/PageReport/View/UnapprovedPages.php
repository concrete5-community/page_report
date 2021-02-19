<?php

namespace A3020\PageReport\View;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class UnapprovedPages implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function view()
    {
        $view = new View('unapproved_pages');
        $view->setPackageHandle('page_report');

        $view->addScopeItems([
            'numberService' => $this->app->make('helper/number'),
            'pages' => $this->app->make(\A3020\PageReport\Statistics\UnapprovedPages::class)->get(),
        ]);

        return $view->render();
    }
}
