<?php

namespace App\AccountBundle\Repository;


use App\AccountBundle\Entity\UserFields;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserFields>
 *
 * @method UserFields|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFields|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFields[]    findAll()
 * @method UserFields[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFieldsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFields::class);
    }

    public function save(UserFields $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserFields $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}