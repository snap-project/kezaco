<?php

namespace Kezaco\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Kezaco\CoreBundle\Entity\ClassYear;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadClassYear extends LoadCSV implements OrderedFixtureInterface
{

    public function getAssociatedEntity() {
        return 'ClassYear';
    }

    public function load(ObjectManager $em)
    {

        $fixtures = $this->getEntityFixtures();
        $repo = $em->getRepository('KezacoCoreBundle:ClassYear');

        foreach($fixtures as $row) {

            $e = $repo->findOneBySlug($row['slug']);
            if(!$e) {
                $e = new ClassYear();
            }

            $e->setTitle($row['title']);
            $e->setSlug($row['slug']);
            $e->setDescription($row['description']);
            $cycle = $em->getRepository('KezacoCoreBundle:Cycle')
                ->findOneBySlug($row['cycle'])
            ;
            $e->setCycle($cycle);

            $em->persist($e);
            $em->flush();

        }

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

}
