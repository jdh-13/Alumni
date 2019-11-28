<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function search($degree, $year)
    {

        return $this->queryPagination($degree, $year)->getResult();
    }

    public function queryPagination($degree, $year)
    {
        $qb=$this->createQueryBuilder('u');
        if($degree || $year)
        {
            $qb->innerJoin('u.promotions','p');
        }
        if($degree)
        {
            $qb
                ->andWhere('p.degree=:degree_id')
                ->setParameter('degree_id',$degree);
        }
        if($year)
        {
            $qb
                ->andWhere('p.year=:year_id')
                ->setParameter('year_id',$year);
        }
        return $qb->getQuery();
    }
// /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
