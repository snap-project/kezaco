<?php

namespace Kezaco\CoreBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\Common\Collections\ArrayCollection;
use Kezaco\CoreBundle\Event\AfterSearchEvent;
use Kezaco\CoreBundle\Event\BeforeSearchEvent;
use Kezaco\CoreBundle\Event\SearchEvents;

class Search extends ContainerAware {

    public function search($search, $limit = 100, $offset = 0) {

        $container = $this->container;
        $dispatcher = $container->get('event_dispatcher');

        $beforeSearchEvent = new BeforeSearchEvent($search, $limit, $offset);
        $dispatcher->dispatch(SearchEvents::BEFORE_SEARCH, $beforeSearchEvent);

        $searchRepo = $container->get('fos_elastica.manager')
            ->getRepository('KezacoCoreBundle:Resource')
        ;

        $results = $searchRepo->find($search);

        $afterSearchEvent = new AfterSearchEvent($search, $results);
        $dispatcher->dispatch(SearchEvents::AFTER_SEARCH, $afterSearchEvent);

        return $results;
    }

}
