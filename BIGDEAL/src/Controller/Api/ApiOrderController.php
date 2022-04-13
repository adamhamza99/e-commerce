<?php

namespace App\Controller\Api;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiOrderController extends AbstractController
{
    const NOT_LOGGED = "Vous n'êtes pas connecté.";

    /**
     * @Route("mon-api/order", name="api_order", methods={"GET"})
     */
    public function index(SerializerInterface $serializer, OrderRepository $orderRepository): Response
    {
        $user = $this->getUser();
        $order = $orderRepository->findByUser($user);

        if ($user != null) {
            if ($orderRepository->findByUser($this->getUser()) != null) {
                $json = $serializer->serialize($order, 'json', [
                    'groups' => 'order:read',
                ]);
                return new Response($json, 200, []);
            } else {
                return new Response("Vous n'avez pas de commande.", 401, []);
            }
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }

    /**
     * @Route("mon-api/order/{id}", name="api_order_id", methods={"GET"})
     */
    public function orderById(SerializerInterface $serializer, OrderRepository $orderRepository, $id): Response
    {
        $order = $orderRepository->findById($id);
        $user = $this->getUser();
        if ($user != null) {
            if ($orderRepository->findByUser($this->getUser()) != null) {
                if ($order[0]->getUser()->getEmail() == $this->getUser()->getEmail()) {
                    $json = $serializer->serialize($order, 'json', [
                        'groups' => 'order:read',
                    ]);
                    return new Response($json, 200, []);
                } else {
                    return new Response("Vous essayez de voir une commande qui n'est pas la votre.", 401, []);
                }
            } else {
                return new Response("Vous n'avez pas de commande.", 401, []);
            }
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }
}
