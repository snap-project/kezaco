<?php

namespace Kezaco\CoreBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\Common\Collections\ArrayCollection;
use Kezaco\CoreBundle\Event\AfterSearchEvent;
use Kezaco\CoreBundle\Event\BeforeSearchEvent;
use Kezaco\CoreBundle\Event\SearchEvents;

class Search extends ContainerAware {

    public function search($search) {

        $finder = $this->container->get('fos_elastica.finder.kezaco.resource');

        $this->dispatchSearchEvent(SearchEvents::BEFORE_SEARCH, $search);
        $results = $finder->find($search);
        $this->dispatchSearchEvent(SearchEvents::AFTER_SEARCH, $search, $results);

        return $results;

    }

    public function searchPaginated($search, $page = 0, $limit = 10) {

        $finder = $this->container->get('fos_elastica.finder.kezaco.resource');
        $paginator = $this->container->get('knp_paginator');

        $this->dispatchSearchEvent(SearchEvents::BEFORE_SEARCH, $search);
        $results = $finder->createPaginatorAdapter($search);
        $this->dispatchSearchEvent(SearchEvents::AFTER_SEARCH, $search, $results);

        return $paginator->paginate($results, $page, $limit);
    }

    protected function dispatchSearchEvent($eventPhase, $search, $results = null)
    {
        switch($eventPhase) {
            case SearchEvents::BEFORE_SEARCH:
                $event = new BeforeSearchEvent($search);
                break;
            case SearchEvents::AFTER_SEARCH:
                $event = new AfterSearchEvent($search, $results);
                break;
            default:
                throw new \Exception('Invalid search event phase !');
        }

        $dispatcher = $this->container->get('event_dispatcher');
        $dispatcher->dispatch($eventPhase, $event);
    }


}
