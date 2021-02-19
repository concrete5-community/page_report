<?php

namespace A3020\PageReport\View;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class PageTemplates implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function view()
    {
        $view = new View('page_templates');
        $view->setPackageHandle('page_report');

        $view->addScopeItems([
            'templates' => $this->app->make(\A3020\PageReport\Statistics\PageTemplates::class)->get(),
        ]);

        return $view->render();
    }
}
