<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{

    /**
     * @Route("/test",name="test")
     *  */
    public function test(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();

        return $this->render(
            'test.html.twig',
            ['products' => $products]
        );
    }

}