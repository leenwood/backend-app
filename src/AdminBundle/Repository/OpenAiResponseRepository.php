<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\OpenAiResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OpenAiResponse>
 *
 * @method OpenAiResponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method OpenAiResponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method OpenAiResponse[]    findAll()
 * @method OpenAiResponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpenAiResponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpenAiResponse::class);
    }

    public function save(OpenAiResponse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OpenAiResponse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OpenAIResponse[] Returns an array of OpenAIResponse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OpenAIResponse
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
