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
      dump($products);

      $favorite = $productRepository->favorite();
      dump($favorite);

        return $this->render('index/index.html.twig', [
          'lastProducts' => $products,
          'favoriteProducts' => $favorite,
        ]);
    }

}
