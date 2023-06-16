<?php

namespace App\Repository;

use App\Entity\RentalEquipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RentalEquipment>
 *
 * @method RentalEquipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalEquipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalEquipment[]    findAll()
 * @method RentalEquipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalEquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalEquipment::class);
    }

    public function save(RentalEquipment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RentalEquipment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RentalEquipment[] Returns an array of RentalEquipment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RentalEquipment
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
