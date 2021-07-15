<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Student;
use App\Entity\StudyField;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    /**
    * @return Student[] Returns an array of Student objects ordered by lastname ASC
    */
    public function findAllLastnameOrdered()
    {
        return $this->createQueryBuilder('s')
            ->join('s.user', 'u')
            ->orderBy('u.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Student[] Returns an array of Student objects ordered by lastname ASC
    */
    public function findByStudyFieldLastnameOrdered(?StudyField $studyField)
    {
        return $this->createQueryBuilder('s')
            ->join('s.user', 'u')
            ->andWhere('s.studyField = :studyField')
            ->setParameter('studyField', $studyField)
            ->orderBy('u.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
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
    public function findOneBySomeField($value): ?Student
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
