<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ProductRepository $productRepository)
    {
      $products = $productRepository->lastAdd();

      $favorite = $productRepository->favorite();

      $randTop = $productRepository->randTop();

      $best = $productRepository->best();

        return $this->render('index/index.html.twig', [
          'lastProducts' => $products,
          'favoriteProducts' => $favorite,
          'best' => $best,
          'randTop' => $randTop
        ]);
    }

}
