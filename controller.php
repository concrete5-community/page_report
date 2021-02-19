<?php

namespace Concrete\Package\PageReport;

use A3020\PageReport\Installer;
use Concrete\Core\Package\Package;
use Concrete\Core\Support\Facade\Package as PackageFacade;

/**
 * @copyright A3020
 * @see https://a3020.com
 */
class Controller extends Package
{
    protected $pkgHandle = 'page_report';
    protected $appVersionRequired = '8.0.0';
    protected $pkgVersion = '1.0.1';
    protected $pkgAutoloaderRegistries = [
        'src/PageReport' => '\A3020\PageReport',
    ];

    public function getPackageName()
    {
        return t('Page Report');
    }

    public function getPackageDescription()
    {
        return t('Display page related statistics.');
    }

    public function install()
    {
        $pkg = parent::install();

        $installer = $this->app->make(Installer::class);
        $installer->install($pkg);
    }

    public function upgrade()
    {
        parent::upgrade();

        $pkg = PackageFacade::getByHandle($this->pkgHandle);

        $installer = $this->app->make(Installer::class);
        $installer->install($pkg);
    }
}
