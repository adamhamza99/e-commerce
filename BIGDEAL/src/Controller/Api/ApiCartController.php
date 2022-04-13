<?php

namespace App\Controller\Api;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiCartController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SessionInterface $session;
    const NOT_LOGGED = "Vous n'êtes pas connecté.";

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    /**
     * @Route("mon-api/cart/{id}", name="api_add_cart", methods={"POST"})
     */
    public function add_cart_product($id): Response
    {
        $cart = $this->session->get('cart', []);
        $user = $this->getUser();

        if ($user != null) {
            if (!empty($cart[$id])) {
                $cart[$id]++;
            } else {
                $cart[$id] = 1;
            }
            $this->session->set('cart', $cart);
            return new Response("Le produit à bien été ajouté au panier.", 201, []);
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }

    /**
     * @Route("mon-api/cart/{id}", name="api_product_cart", methods={"DELETE"})
     */
    public function api_remove_cart($id): Response
    {
        $user = $this->getUser();
        if ($user != null) {
            $cart = $this->session->get('cart', []);
            unset($cart[$id]);
            $this->session->set('cart', $cart);
            return new Response("Le produit à bien été suprimer du panier.", 200, []);
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }

    /**
     * @Route("mon-api/cart/", name="api_getfull_cart", methods={"GET"})
     */
    public function api_get_cart(SerializerInterface $serializer): Response
    {
        $user = $this->getUser();

        if ($user != null) {
            $cartComplete = [];
            if ($this->session->get('cart')) {
                foreach ($this->session->get('cart') as $id => $quantity) {
                    $product_object = $this->entityManager->getRepository(Product::class)->findOneById($id);
                    if (!$product_object) {
                        $cart = $this->session->get('cart', []);
                        unset($cart[$id]);
                        continue;
                    }
                        $cartComplete[] = [
                        'product' => $product_object,
                        'quantity' => $quantity
                    ];
                }
            }
            $cart_encoded = $serializer->serialize($cartComplete, 'json', [
                'groups' => 'order:read',
                'groups' => 'product:read'
            ]);
            return new Response($cart_encoded, 200, []);
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }


}
