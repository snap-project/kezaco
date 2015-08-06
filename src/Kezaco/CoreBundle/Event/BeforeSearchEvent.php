<?php

namespace Kezaco\CoreBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class BeforeSearchEvent extends Event
{
    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function getSearch()
    {
        return $this->search;
    }
}
