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
}