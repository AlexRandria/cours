<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session, EntityManagerInterface $em): Response
    {
        $carts = [];
        $cart = $session->get('cart', []);
        $cart_view = array_count_values($cart);
        foreach ($cart_view as $key => $value) {
            $product = $em->getRepository(Product::class)->find($key);
            $products = ['product' => $product, 'quantite' => $value];
            array_push($carts, $products);
        }
        return $this->render('cart/index.html.twig', [
            'carts' => $carts,
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="addToCart")
     */
    public function add(SessionInterface $session, EntityManagerInterface $em, $id): Response
    {
        $cart = $session->get('cart', []);

        array_push($cart, $id);
        $session->set('cart', $cart);
        // $session->remove('cart');


        $this->addFlash('success', 'Votre produit a bien été ajouter au panier');
        return $this->redirectToRoute('index');
    }

}
