<?php

namespace App\Repository;

use App\Entity\OtherTestAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OtherTestAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method OtherTestAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method OtherTestAnswer[]    findAll()
 * @method OtherTestAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtherTestAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OtherTestAnswer::class);
    }

    // /**
    //  * @return OtherTestAnswer[] Returns an array of OtherTestAnswer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OtherTestAnswer
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
