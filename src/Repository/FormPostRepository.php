<?php

namespace App\Repository;

use App\Entity\FormPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormPost[]    findAll()
 * @method FormPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormPost::class);
    }

    // /**
    //  * @return FormPost[] Returns an array of FormPost objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormPost
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
