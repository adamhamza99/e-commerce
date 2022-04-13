<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/compte", name="account")
     */
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    /**
     * @Route("/compte/mes-commandes", name="account_order")
     */
    public function show(): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOrder($this->getUser());
        return $this->render('account/my_order.html.twig', [
            'order' => $order
        ]);
    }


    /**
     * @Route("/compte/mes-commandes/{id}", name="account_order_show")
     */
    public function show_order($id): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOrderById($id);
    //   dd($order);
        return $this->render('account/my_order_show.html.twig', [
            'order' => $order
        ]);
    }
}
