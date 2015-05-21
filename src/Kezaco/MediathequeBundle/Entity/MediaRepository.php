<?php

namespace Kezaco\MediathequeBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Kezaco\CoreBundle\Entity\User;

class MediaRepository extends EntityRepository
{

  public function findAllByFilter(User $user, $filters = [] )
  {
    $qb = $this->createQueryBuilder('m');
    $qb->join('m.users', 'u')
      ->where('u.id = :user_id')
      ->setParameter('user_id' , $user->getId(), \Doctrine\DBAL\Types\Type::INTEGER);

    if (!empty($filters)) {
      $filters = array_keys($filters);

      foreach( $filters as $k => $filter ) {
        if ($k == 0) {
          $qb->andWhere($qb->expr()->like('m.contentType', $qb->expr()->literal('%'.$filter.'%')));
        }
        else {
          $qb->orWhere($qb->expr()->like('m.contentType', $qb->expr()->literal('%'.$filter.'%')));
        }
      }
    }

    return $qb->getQuery()->getResult();
  }

}
