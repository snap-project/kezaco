<?php
namespace Kezaco\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class LoadCSV extends AbstractFixture implements ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Return the file for the current model.
     */
    abstract function getAssociatedEntity();

    public function getEntityFixtures()
    {
        $rootDir = $this->container->getParameter('kernel.root_dir');
        $fixturesPath = $rootDir. '/data/fixtures';
        $fixturesPath .=  '/' . $this->getAssociatedEntity(). '.csv';

        $fixtures = array();
        $headers = array();
        if (($handle = fopen($fixturesPath, "r")) !== false) {
            $isHeaders = true;
            while (($row = fgetcsv($handle, null, ";")) !== false) {
                if ($isHeaders) {
                  $headers = $row; // On récupère les entêtes des colonnes
                  $isHeaders = false;
                  continue;
                }
                $fixtures[] = array_combine($headers, $row);
            }
            fclose($handle);
        }
        return $fixtures;
    }

}
