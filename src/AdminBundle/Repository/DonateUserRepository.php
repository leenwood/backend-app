<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\DonateUser;
use App\AdminBundle\Entity\Goal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<DonateUser>
 *
 * @method DonateUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonateUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonateUser[]    findAll()
 * @method DonateUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonateUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonateUser::class);
    }

    public function save(DonateUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DonateUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getDonationUsersByGoal(Goal $goal): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.goal = :val')
            ->setParameter('val', $goal->getId())
            ->getQuery()
            ->getResult();
    }
}