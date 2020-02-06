<?php


namespace App\Repository;


use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Product::class);
  }

  public function findAll(){
    $queryBuilder = $this->createQueryBuilder('p')
      ->orderBy('p.id','DESC')
      ->getQuery();

    return $queryBuilder->getResult();
  }

  public function lastAdd(){
    $queryBuilder = $this->createQueryBuilder('p')
      ->orderBy('p.date','DESC')
      ->setMaxResults(4)
      ->getQuery();

    return $queryBuilder->getResult();
  }

  public function last(){
    $queryBuilder = $this->createQueryBuilder('p')
      ->orderBy('p.date','DESC')
      ->setMaxResults(1)
      ->getQuery();

    return $queryBuilder->getResult();
  }

  public function favorite(){
    $queryBuilder = $this->createQueryBuilder('p')
      ->where('p.coeur = 1')
      ->setMaxResults(4)
      ->getQuery();

    return $queryBuilder->getResult();
  }

  public function best(){
    $queryBuilder = $this->createQueryBuilder('p')
      ->where('p.coeur = 1')
      ->setMaxResults(1)
      ->getQuery();

    return $queryBuilder->getResult();
  }
}