<?php

namespace Kezaco\MediathequeBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MediaRepository extends EntityRepository
{

  public function findAllByFilter( $filters = [] )
  {
    $qb = $this->createQueryBuilder('m');

    if (!empty($filters)) {
      $filters = array_keys($filters);

      foreach( $filters as $k => $filter ) {
        if ($k == 0) {
          $qb->where($qb->expr()->like('m.contentType', $qb->expr()->literal('%'.$filter.'%')));
        }
        else {
          $qb->orWhere($qb->expr()->like('m.contentType', $qb->expr()->literal('%'.$filter.'%')));
        }
      }
    }

    return $qb->getQuery()->getResult();
  }

}
