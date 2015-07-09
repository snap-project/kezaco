<?php

namespace Kezaco\CoreBundle\EventListener;

use Kezaco\CoreBundle\Event\BeforeSearchEvent;
use Kezaco\CoreBundle\Service\JsonApiClient;
use Doctrine\ORM\EntityManager;
use Kezaco\CoreBundle\Entity\RemoteResource;

class AbuleduSearchListener
{

    const ABULEDU_DATA_SOURCE = 'abuledu_data';

    protected $jsonClient;
    protected $em;

    public function __construct(JsonApiClient $jsonClient, EntityManager $em) {
        $this->jsonClient = $jsonClient;
        $this->em = $em;
    }

    public function onBeforeSearch(BeforeSearchEvent $event)
    {

        $repo = $this->em->getRepository('KezacoCoreBundle:RemoteResource');

        $url = sprintf('http://data.abuledu.org/search.php?terms=%s', $event->getSearch());
        $data = $this->jsonClient->get($url);

        $rows = $data['rows'];

        if($data === null) return;

        foreach($rows as $entry) {

            $res = $repo->findOneBy([
                'source' => AbuleduSearchListener::ABULEDU_DATA_SOURCE,
                'remoteId' => $entry['docNumber']
            ]);

            if(!$res) {
                $res = new RemoteResource();
                $res->setSource(AbuleduSearchListener::ABULEDU_DATA_SOURCE);
                $res->setRemoteId($entry['docNumber']);
                $this->em->persist($res);
            }

            $res->setTitle($entry['title']);
            $res->setDescription($entry['docResume']);
            $res->setUrl(sprintf('http://data.abuledu.org/wp/?LOM=%s', $entry['docNumber']));

        }

        $this->em->flush();

        // echo "<pre>";
        // var_dump($data);
        // echo '</pre>';

    }

}
