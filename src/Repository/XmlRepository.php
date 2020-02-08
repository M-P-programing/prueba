<?php

namespace App\Repository;

use App\Entity\Xml;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Xml|null find($id, $lockMode = null, $lockVersion = null)
 * @method Xml|null findOneBy(array $criteria, array $orderBy = null)
 * @method Xml[]    findAll()
 * @method Xml[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XmlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Xml::class);
    }

    // /**
    //  * @return Xml[] Returns an array of Xml objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('x.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Xml
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
