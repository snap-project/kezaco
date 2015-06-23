<?php

namespace Kezaco\CoreBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class ResourceRepository extends Repository
{

    public function findPopular()
    {
      return [
        ['title' => 'Res 1', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...'],
        ['title' => 'Res 2', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...'],
        ['title' => 'Res 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...']
      ];
    }

    public function findRecent()
    {
      return [
        ['title' => 'Res 4', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...'],
        ['title' => 'Res 5', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...'],
        ['title' => 'Res 6', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...']
      ];
    }

}
