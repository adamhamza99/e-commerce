<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $products_best = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $products_new = $this->entityManager->getRepository(Product::class)->findByIsNew(1);
            //  dd($products_new);
        return $this->render('home/index.html.twig', [
            'products' => $products_best,
            'products_new' => $products_new
        ]);
    }
}
