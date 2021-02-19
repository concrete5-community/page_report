<?php

namespace A3020\PageReport\Result;

class PagesByAuthorResult
{
    /** @var string */
    private $author;

    /** @var int */
    private $numberOfPages;

    /**
     * @param string $author
     * @param int $numberOfFiles
     */
    public function __construct($author, $numberOfFiles)
    {
        $this->author = $author;
        $this->numberOfPages = $numberOfFiles;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getNumberOfPages()
    {
        return $this->numberOfPages;
    }
}
