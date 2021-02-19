<?php

namespace Concrete\Package\PageReport\Controller\SinglePage\Dashboard\Sitemap;

use A3020\PageReport\View\Chart\PagesByAuthor;
use A3020\PageReport\View\Chart\PagesCreated;
use A3020\PageReport\View\Chart\PagesUpdated;
use A3020\PageReport\View\GeneralStatistics;
use A3020\PageReport\View\PageTemplates;
use A3020\PageReport\View\PageTypes;
use A3020\PageReport\View\UnapprovedPages;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Page\Controller\DashboardPageController;

final class PageReport extends DashboardPageController
{
    public function view()
    {
        // Charts
        $this->set('pagesByAuthorChart', $this->app->make(PagesByAuthor::class)->view());
        $this->set('pagesCreatedChart', $this->app->make(PagesCreated::class)->view());
        $this->set('pagesUpdatedChart', $this->app->make(PagesUpdated::class)->view());

        // Other statistics
        $this->set('generalStatistics', $this->app->make(GeneralStatistics::class)->view());
        $this->set('unapprovedPages', $this->app->make(UnapprovedPages::class)->view());
        $this->set('pageTemplates', $this->app->make(PageTemplates::class)->view());
        $this->set('pageTypes', $this->app->make(PageTypes::class)->view());
    }

    public function on_before_render()
    {
        parent::on_before_render();

        $al = AssetList::getInstance();

        $al->register('javascript', 'page_report/chart', 'js/Chart.bundle.min.js', [], 'page_report');
        $al->register('javascript', 'page_report/chart_piece_label', 'js/Chart.PieceLabel.min.js', [], 'page_report');
        $al->register('javascript', 'page_report/datatables', 'js/datatables.min.js', [], 'page_report');
        $this->requireAsset('javascript', 'page_report/chart');
        $this->requireAsset('javascript', 'page_report/chart_piece_label');
        $this->requireAsset('javascript', 'page_report/datatables');

        $al->register('css', 'page_report/summary', 'css/summary.css', [], 'page_report');
        $al->register('css', 'page_report/datatables', 'css/datatables.css', [], 'page_report');
        $this->requireAsset('css', 'page_report/summary');
        $this->requireAsset('css', 'page_report/datatables');
    }
}
