<?php

namespace Tgorz\TrainingBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function findByNot($field, $value){
        $qb = $this->createQueryBuilder('a');
        $qb->where('a. '.$field. '!= :identifier')->orWhere('a.role IS NULL')
                ->setParameter('identifier', $value);
        
        return $qb->getQuery()->getResult();
    }
}
