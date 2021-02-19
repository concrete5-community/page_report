<?php

namespace A3020\PageReport\Result;

use Concrete\Core\Support\Facade\Url;

class PageTypeResult
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $handle;

    /** @var int */
    private $pages;

    /**
     * @param int $id
     * @param string $handle
     * @param string $name
     * @param int $pages
     */
    public function __construct($id, $handle, $name, $pages)
    {
        $this->id = $id;
        $this->handle = $handle;
        $this->name = $name;
        $this->pages = $pages;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getHandle()
    {
        return $this->handle;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumberOfPages()
    {
        return $this->pages;
    }

    public function getLink()
    {
        return URL::to('/dashboard/pages/types/edit/'.$this->id);
    }
}
