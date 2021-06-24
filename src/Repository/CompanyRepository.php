<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function findSearch(SearchData $search): array
    {
        $query = $this->createQueryBuilder('company');

        if (!empty($search->searchQuery)) {
            $query = $query
            ->andWhere('company.companyName LIKE :searchQuery')
            ->setParameter('searchQuery', "%{$search->searchQuery}%");
        }
        return $query->getQuery()->getResult();
    }
}
