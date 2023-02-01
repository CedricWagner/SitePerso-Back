<?php

namespace App\Repository;

use App\Entity\SkillGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SkillGroup>
 *
 * @method SkillGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillGroup[]    findAll()
 * @method SkillGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillGroup::class);
    }

    public function save(SkillGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SkillGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
