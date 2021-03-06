<?php

namespace ShoppingCartBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function findByBan()
    {
        return $this->createQueryBuilder('user')
            ->where('user.ban = 1')
            ->orderBy('user.fullName', 'ASC')
            ->getQuery()
            ->getResult();
    }
}