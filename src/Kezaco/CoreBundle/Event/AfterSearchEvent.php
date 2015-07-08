<?php

namespace Kezaco\CoreBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class AfterSearchEvent extends Event
{
    protected $search;
    protected $results;

    public function __construct($search, &$results)
    {
        $this->search = $search;
        $this->results = $results;
    }

    public function getSearch()
    {
        return $this->search;
    }

    public function getResults()
    {
        return $this->results;
    }
}
