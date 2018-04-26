<?php

namespace AppBundle\Repository;

/**
 * UzytkownikRepository
 */
class UzytkownikRepository extends \Doctrine\ORM\EntityRepository
{
    public function findForList()
    {
        $qb = $this
            ->createQueryBuilder('uzytkownik')
            ->select('uzytkownik')
            ->addOrderBy('uzytkownik.dataRejestracji', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }
}
