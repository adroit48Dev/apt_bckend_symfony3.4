<?php

namespace EmpBundle\Repository;

use AppBundle\Entity\User;

/**
 * JobListRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class JobListRepository extends \Doctrine\ORM\EntityRepository
{

    public function unfeature()
    {
        $qb = $this->createQueryBuilder('job');

        return $qb->update()
            ->set('job.isFeatured', '0')
            ->andWhere('job.featuredUntil > CURRENT_TIMESTAMP()')
            ->getQuery()
            ->execute();
    }

    public function unpublish()
    {
        $qb = $this->createQueryBuilder('job');

        return $qb->update()
            ->set('job.isPublished', '0')
            ->andWhere('job.publishedUntil > CURRENT_TIMESTAMP()')
            ->getQuery()
            ->execute();
    }

    public function findRecent($count = 8)
    {
        $qb = $this->createQueryBuilder('job');

        return $qb->orderBy('job.createdAt', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
            ->execute();
    }

    public function findByFilterQuery($request)
    {
        $qb = $this->createQueryBuilder('job');


        // Keyword
        if (!empty($request->query->get('keyword'))) {
            $qb->andWhere('job.title LIKE :filterKeyword OR  LIKE :filterKeyword')
                ->setParameter('filterKeyword', '%' . $request->query->get('keyword') . '%');
        }

    }

    public function findUserJobs(User $user)
    {
        if (!$user) {
            return false;
        }

        $qb = $this->createQueryBuilder('job');

        return $qb
//            ->setParameter('companies', $user->getCompanies())
            ->orderBy('job.created', 'DESC')
            ->addOrderBy('job.id', 'DESC')
            ->getQuery()
            ->execute();
    }
}
