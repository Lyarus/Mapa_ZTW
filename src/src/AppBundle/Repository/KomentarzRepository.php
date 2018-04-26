<?php

namespace AppBundle\Repository;

/**
 * KomentarzRepository
 */
class KomentarzRepository extends \Doctrine\ORM\EntityRepository
{
    public function findForList($filter)
    {
        $qb = $this
            ->createQueryBuilder('komentarz')
            ->select('komentarz')
            ->addOrderBy('komentarz.dataCzasKom', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }
}
