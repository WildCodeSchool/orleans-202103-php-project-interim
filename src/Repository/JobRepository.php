<?php

namespace App\Repository;

use App\Entity\Job;
use App\Entity\CompanyRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function findCompanyOffers(int $id): ?Job
    {
        return $this->createQueryBuilder('job')
            ->select(
                'job.id',
                'job.post',
                'job.registeredAt',
                'job.startAt',
                'job.endAt',
                'job.hoursAWeek',
                'job.city',
                'job.postalCode',
                'job.description',
                'company.companyName',
            )
            ->from('job', 'j')
            ->join('job', 'company', 'company.id = job.company_id')
            ->where('company.id=:id')
            ->setParameter('id', $id)
            ->orderBy('job.registeredAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Job[] Returns an array of Job objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Job
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
