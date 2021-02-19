<?php

namespace A3020\PageReport\Result;

class PagesUpdatedResult
{
    /** @var int */
    private $numberOfPages;
    private $year;
    private $month;

    /**
     * @param int $numberOfPages
     * @param string $year
     * @param string $month
     */
    public function __construct($numberOfPages, $year, $month)
    {
        $this->numberOfPages = $numberOfPages;
        $this->year = $year;
        $this->month = $month;
    }

    /**
     * @return int
     */
    public function getNumberOfPages()
    {
        return $this->numberOfPages;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return (int) $this->year;
    }

    /**
     * @return int
     */
    public function getMonth()
    {
        return (int) $this->month;
    }
}
