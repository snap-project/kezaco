<?php

namespace Kezaco\CoreBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class ResourceRepository extends Repository
{

    public function findPopular()
    {
      return [
        ['id' => 0, 'title' => 'Res 1', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...'],
        ['id' => 0, 'title' => 'Res 2', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...'],
        ['id' => 0, 'title' => 'Res 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...']
      ];
    }

    public function findRecent()
    {
      return [
        ['id' => 0, 'title' => 'Res 4', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...'],
        ['id' => 0, 'title' => 'Res 5', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...'],
        ['id' => 0, 'title' => 'Res 6', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit ...']
      ];
    }

}
