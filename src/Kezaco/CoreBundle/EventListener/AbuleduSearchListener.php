<?php

namespace Kezaco\CoreBundle\EventListener;

use Kezaco\CoreBundle\Event\BeforeSearchEvent;

class AbuleduSearchListener
{

    protected $jsonClient;

    public function __construct($jsonClient) {
        $this->jsonClient = $jsonClient;
    }

    public function onBeforeSearch(BeforeSearchEvent $event)
    {

        $url = 'http://data.abuledu.org/search.php?terms='.$event->getSearch();
        $data = $this->jsonClient->get($url);

        echo "<pre>";
        var_dump($data);
        echo '</pre>';

    }

}
