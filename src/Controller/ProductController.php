<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

  /**
   * @Route("/product", name="products")
   */
  public function list(ProductRepository $productRepository, CategoryRepository $categoryRepository)
  {
    $products = $productRepository->findAll();

    $last = $productRepository->last();

    $colors = $productRepository->allColors();

    $categories = $categoryRepository->categories();

    return $this->render('product/index.html.twig', [
      'products' => $products,
      'last' => $last,
      'allColors' => $colors,
      'categories' => $categories
    ]);
  }

  /**
   * @Route("/product/{slug}", name="product_show")
   */
  public function show($slug, CategoryRepository $categoryRepository){
    $productRepository = $this->getDoctrine()->getRepository(Product::class);

    $product = $productRepository->findOneBySlug($slug);
    $categories = $categoryRepository->categories();
    if (!$product) {
      throw $this->createNotFoundException('Le produit n\'existe pas.');
    }

    return $this->render('product/show.html.twig', [
      'product' => $product,
    ]);
  }

}
