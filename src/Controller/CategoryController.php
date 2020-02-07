<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

  /**
   * @Route("/category/{slug}", name="category_show", methods={"GET"})
   */
  public function show($slug, ProductRepository $productRepository){
    $categoryRepository = $this->getDoctrine()->getRepository(Category::class);

    $products = $productRepository->findAll();

    $last = $productRepository->last();

    $categories = $categoryRepository->categories();
    $category = $categoryRepository->findOneBySlug($slug);

    if (!$category) {
      throw $this->createNotFoundException('La catégorie n\'existe pas.');
    }

    return $this->render('category/show.html.twig', [
      'category' => $category,
      'products' => $products,
      'last' => $last,
      'categories' => $categories
    ]);
  }
}
