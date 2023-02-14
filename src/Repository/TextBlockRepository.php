<?php

namespace App\Repository;

use App\Entity\TextBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TextBlock>
 *
 * @method TextBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextBlock[]    findAll()
 * @method TextBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextBlock::class);
    }

    public function save(TextBlock $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TextBlock $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
