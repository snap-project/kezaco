<?php

namespace Kezaco\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Kezaco\CoreBundle\Entity\Cycle;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCycle extends LoadCSV implements OrderedFixtureInterface
{

    public function getAssociatedEntity() {
        return 'Cycle';
    }

    public function load(ObjectManager $em)
    {

        $fixtures = $this->getEntityFixtures();
        $repo = $em->getRepository('KezacoCoreBundle:Cycle');

        foreach($fixtures as $row) {

            $e = $repo->findOneBySlug($row['slug']);
            if(!$e) {
                $e = new Cycle();
            }

            $e->setTitle($row['title']);
            $e->setSlug($row['slug']);
            $e->setDescription($row['description']);

            $em->persist($e);
            $em->flush();

        }

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}
