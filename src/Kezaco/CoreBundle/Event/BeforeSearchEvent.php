<?php

namespace Kezaco\CoreBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class BeforeSearchEvent extends Event
{
    protected $search;
    protected $limit;
    protected $offset;

    public function __construct($search, $limit, $offset)
    {
        $this->search = $search;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function getSearch()
    {
        return $this->search;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getOffset()
    {
        return $this->offset;
    }
}
