<?php

namespace App\AccountBundle\Repository;


use App\AccountBundle\Entity\Account;
use App\AccountBundle\Exception\NotFoundAccountWithRoleException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Account>
 *
 * @method Account|null find($id, $lockMode = null, $lockVersion = null)
 * @method Account|null findOneBy(array $criteria, array $orderBy = null)
 * @method Account[]    findAll()
 * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function save(Account $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Account $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Account) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }

    /**
     * @param string $role
     * @return array
     * @throws NotFoundAccountWithRoleException
     */
    public function getAccountsByRole(string $role): array
    {

        $rsm = $this->createResultSetMappingBuilder('a');

        $rawQuery = sprintf(
            'SELECT %s
        FROM account a
        WHERE a.roles::jsonb ?? :role', //Работать будет только у пгбд
            $rsm->generateSelectClause()
        );

        $query = $this->getEntityManager()->createNativeQuery($rawQuery, $rsm);
        $query->setParameter('role', $role);

        $result = $query->getResult();

        if (is_null($result) || empty($result)) {
            throw new NotFoundAccountWithRoleException(sprintf("Not found account with role: %s", $role));
        }
        return $result;
    }
}
