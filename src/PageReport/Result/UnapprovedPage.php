<?php

namespace A3020\PageReport\Result;

use Concrete\Core\Support\Facade\Url;

class UnapprovedPage
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $dateModified;

    /**
     * @param $id
     * @param $name
     * @param $dateModified
     */
    public function __construct($id, $name, $dateModified)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dateModified = $dateModified;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getLink()
    {
        return URL::to('?cID='.$this->id);
    }

    /**
     * @return string
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }
}
