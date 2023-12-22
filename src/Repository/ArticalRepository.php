<?php

namespace App\Repository;

use App\Entity\Artical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artical>
 *
 * @method Artical|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artical|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artical[]    findAll()
 * @method Artical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artical::class);
    }

    public function getActiveBlogCounter()
    {
        return $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
