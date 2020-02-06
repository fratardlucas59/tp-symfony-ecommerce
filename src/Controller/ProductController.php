<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

  /**
   * @Route("/product", name="products")
   */
  public function list(ProductRepository $productRepository)
  {
    $products = $productRepository->findAll();

    return $this->render('product/index.html.twig', [
      'products' => $products,
    ]);
  }
}
