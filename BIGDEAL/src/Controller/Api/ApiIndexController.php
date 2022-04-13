<?php

namespace App\Controller\Api;

use App\Entity\Order;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiIndexController extends AbstractController
{
    /**
     * @Route("mon-api/", name="index_api_controller")
     */
    public function index(EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        if ($this->getUser())
        {
            $id = $this->getUser()->getId();
            $order = $entityManager->getRepository(Order::class)->findOneByUser($this->getUser()->getId());
            if ($order != null)
            {
                $order_id = $order->getId();
            } else {
                $order_id = 0;
            }
        } else {
            $id = 0;
            $order_id = 0;
        }

        return $this->render('api_index/index.html.twig', [
            'controller_name' => 'ApiIndexController',
            'id' => $id,
            'order_id' => $order_id
        ]);
    }
}
