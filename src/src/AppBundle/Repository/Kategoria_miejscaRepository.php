<?php

namespace AppBundle\Repository;

/**
 * Kategoria_miejscaRepository
 */
class Kategoria_miejscaRepository extends \Doctrine\ORM\EntityRepository
{
    public function findForList($filter)
    {
        $qb = $this
            ->createQueryBuilder('kategoria_miejsca')
            ->select('kategoria_miejsca')
            ->addOrderBy('kategoria_miejsca.nazwaK', 'ASC');

        return $qb->getQuery()->getResult();
    }
}