<?php

namespace App\Controller;

use App\Entity\Product;
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

    $last = $productRepository->last();

    return $this->render('product/index.html.twig', [
      'products' => $products,
      'last' => $last
    ]);
  }

  /**
   * @Route("/product/{slug}", name="product_show")
   */
  public function show($slug){
    $productRepository = $this->getDoctrine()->getRepository(Product::class);

    $product = $productRepository->findOneBySlug($slug);

    if (!$product) {
      throw $this->createNotFoundException('Le produit n\'existe pas.');
    }

    return $this->render('product/show.html.twig', [
      'product' => $product,
    ]);
  }

}
