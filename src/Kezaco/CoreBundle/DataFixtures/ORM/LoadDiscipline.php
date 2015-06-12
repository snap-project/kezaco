<?php

namespace Kezaco\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Kezaco\CoreBundle\Entity\Discipline;

class LoadDiscipline extends LoadCSV
{

    public function getAssociatedEntity() {
        return 'Discipline';
    }

    public function load(ObjectManager $em)
    {

        $fixtures = $this->getEntityFixtures();
        $repo = $em->getRepository('KezacoCoreBundle:Discipline');

        foreach($fixtures as $row) {

            $e = $repo->findOneBySlug($row['slug']);
            if(!$e) {
                $e = new Discipline();
            }

            $e->setTitle($row['title']);
            $e->setSlug($row['slug']);
            $e->setDescription($row['description']);

            $em->persist($e);
            $em->flush();

        }

    }

}
