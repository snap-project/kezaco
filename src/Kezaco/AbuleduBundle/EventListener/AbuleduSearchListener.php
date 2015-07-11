<?php

namespace Kezaco\AbuleduBundle\EventListener;

use Kezaco\CoreBundle\Event\BeforeSearchEvent;
use Kezaco\CoreBundle\Service\JsonApiClient;
use Doctrine\ORM\EntityManager;
use Kezaco\CoreBundle\Entity\RemoteResource;
use Doctrine\Common\Cache\Cache;

class AbuleduSearchListener
{
    protected $jsonClient;
    protected $em;
    protected $cache;
    protected $config;

    public function __construct(JsonApiClient $jsonClient, EntityManager $em, Cache $cache) {
        $this->jsonClient = $jsonClient;
        $this->em = $em;
        $this->cache = $cache;
    }

    public function onBeforeSearch(BeforeSearchEvent $event)
    {
        $repo = $this->em->getRepository('KezacoCoreBundle:RemoteResource');
        $search = $event->getSearch();

        foreach( $this->config as $conf) {

            $endpoint = $conf['endpoint'];
            $source = $endpoint['source_id'];

            $url = sprintf($endpoint['search_url_pattern'], $search);

            $data = $this->jsonClient->get($url);

            if($data === null || !isset($data['rows'])) return;

            $rows = $data['rows'];

            $cacheKey = $source.'_search_'.md5($search);
            $lastSearchTimestamp = $this->cache->fetch($cacheKey);
            $delta = time() - intval($lastSearchTimestamp);

            if( $lastSearchTimestamp !== false &&
                $delta < $endpoint['refresh_rate'] ) {
                return;
            }

            foreach($rows as $entry) {

                $res = $repo->findOneBy([
                    'source' => $source,
                    'remoteId' => $entry['docNumber']
                ]);

                if(!$res) {
                    $res = new RemoteResource();
                    $res->setSource($source);
                    $res->setRemoteId($entry['docNumber']);
                    $this->em->persist($res);
                }

                $res->setTitle($entry['title']);
                $res->setDescription($entry['docResume']);
                $res->setUrl(sprintf($endpoint['resource_url_pattern'], $entry['docNumber']));

            }

            $this->em->flush();

            $this->cache->save($cacheKey, time());
        }




    }

    public function setConfig($config) {
        $this->config = $config;
    }

}
