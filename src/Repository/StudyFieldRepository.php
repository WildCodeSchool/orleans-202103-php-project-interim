<?php

namespace App\Repository;

use App\Entity\StudyField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudyField|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudyField|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudyField[]    findAll()
 * @method StudyField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudyFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudyField::class);
    }

    // /**
    //  * @return StudyField[] Returns an array of StudyField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudyField
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
