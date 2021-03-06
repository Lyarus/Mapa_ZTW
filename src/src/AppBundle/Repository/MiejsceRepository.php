<?php

namespace AppBundle\Repository;

/**
 * MiejsceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MiejsceRepository extends \Doctrine\ORM\EntityRepository
{
    public function findForList()
    {
        $qb = $this
            ->createQueryBuilder('miejsce')
            ->select('miejsce')
            ->addOrderBy('miejsce.idMiejsce', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }


}
