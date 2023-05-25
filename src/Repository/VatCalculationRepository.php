<?php

/**
 * VAT CALCULATOR APP.
 * (c) ktarila <ktarila@gmail.com>.
 */

namespace App\Repository;

use App\Entity\VatCalculation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VatCalculation>
 *
 * @method VatCalculation|null find($id, $lockMode = null, $lockVersion = null)
 * @method VatCalculation|null findOneBy(array $criteria, array $orderBy = null)
 * @method VatCalculation[]    findAll()
 * @method VatCalculation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VatCalculationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VatCalculation::class);
    }

    public function save(VatCalculation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VatCalculation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     *  Delete all vat calculations.
     */
    public function removeAll(): void
    {
        $dql = 'DELETE FROM App:VatCalculation';
        $this->getEntityManager()->createQuery($dql)
            ->execute()
        ;
    }

//    /**
//     * @return VatCalculation[] Returns an array of VatCalculation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VatCalculation
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
