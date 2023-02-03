<?php

namespace App\Repository;

use App\Entity\ProfileInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfileInformation>
 *
 * @method ProfileInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfileInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfileInformation[]    findAll()
 * @method ProfileInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfileInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfileInformation::class);
    }

    public function save(ProfileInformation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProfileInformation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
