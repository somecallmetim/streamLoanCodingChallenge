<?php

namespace App\Repository;

use App\Entity\Branch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Branch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Branch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Branch[]    findAll()
 * @method Branch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BranchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Branch::class);
    }

    public function findByCountryAndStateThenGiveAverageActiveLoanValue($country, $state){
        $connection = $this->getEntityManager()->getConnection();
        $sql = 'SELECT AVG(`value`)
                FROM branch 
                INNER JOIN loan
                ON branch.id = loan.branch_id
                WHERE country = ? AND state = ? AND is_active = ?';
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $country);
        $stmt->bindValue(2, $state);
        $stmt->bindValue(3, 1);
        $result = $stmt->executeQuery();

        return $result->fetchAllAssociative();
    }
    // /**
    //  * @return Branch[] Returns an array of Branch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Branch
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
