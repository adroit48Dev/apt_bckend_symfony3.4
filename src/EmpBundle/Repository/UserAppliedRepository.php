<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 14/6/18
 * Time: 3:03 PM
 */

namespace EmpBundle\Repository;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserAppliedRepository extends EntityRepository
{

    public function findAllForUser(User $user)
    {
        $qb = $this->createQueryBuilder('favorite');

        return $qb->innerJoin('favorite.job', 'job')
            ->andWhere('favorite.user = :user')
            ->andWhere('job.isPublished = 1')
            ->orderBy('favorite.created', 'DESC')
            ->orderBy('favorite.id', 'DESC')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }

}