<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Mail;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\User;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/commande", name="order")
     */
    public function index(Cart $cart, Request $request): Response
    {
        if (!$this->getUser()->getAddresses()->getValues()) {
            return $this->redirectToRoute('account_address_add');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);


        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }

    /**
     * @Route("/commande/recapitulatif", name="order_recap", methods={"POST"})
     */
    public function add(Cart $cart, Request $request): Response
    {
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $carriers = $form->get('carriers')->getData();
            $delivery = $form->get('addresses')->getData();
            $delivery_content = $delivery->getFirstname().' '.$delivery->getLastname();
            $delivery_content .= '<br/>'.$delivery->getPhone();

            if ($delivery->getCompany()) {
                $delivery_content .= '<br/>'.$delivery->getCompany();
            }
            $delivery_content .= '<br/>'.$delivery->getAddress();
            $delivery_content .= '<br/>'.$delivery->getPostal().' '.$delivery->getCity();
            $delivery_content .= '<br/>'.$delivery->getCountry();

            //  dd($delivery_content);

            $order = new Order();
            $order->setUser($this->getUser());
            $order->setCreatedAt($date);
            $order->setCarrierName($carriers);
            $order->setCarrierPrice($carriers->getPrice());
            $order->setDelivery($delivery_content);
            $order->setIsPaid(0);

            $this->entityManager->persist($order);

            foreach ($cart->getFull() as $product) {
                $orderDetails = new OrderDetails();
                $orderDetails->setMyOrder($order);
                $orderDetails->setProduct($product['product']->getName());
                $orderDetails->setQuantity($product['quantity']);
                $orderDetails->setPrice($product['product']->getPrice());
                $orderDetails->setTotal($product['product']->getPrice() * $product['quantity']);
                //    dd($orderDetails);
                $this->entityManager->persist($orderDetails);
            }
            $this->entityManager->flush();

            return $this->render('order/add.html.twig', [
                'cart' => $cart->getFull(),
                'carrier' => $carriers,
                'delivery' => $delivery_content
            ]);
        }
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/commande/confirmation", name="order_confirm")
     */
    public function confirm(): Response
    {
        $mail = new Mail();
        $order = $this->entityManager->getRepository(Order::class)->findOrder($this->getUser());
        $total_price = (($order[0]->getTotal() / 100) + $order[0]->getCarrierPrice());
    //  dd($order);
        if($order) {
            $content = "Bonjour ".$this->getUser()->getFullName()."<br/>Nous vous remercions pour votre commande d'un montant de : <strong>".$total_price." € </strong>.<br/><br><br/>Elle sera préparée dans notre entrepôt et vous serez livré très prochainement à l'adresse suivante : <br/><br/><i><strong> ".$order[0]->getDelivery()."</strong></i><br/><br/>À très bientot<br/>L'équipie BIGDEAL.";
            $mail->send($this->getUser()->getEmail(), $this->getUser()->getFullName(), 'Confirmation de votre commande.', $this->getUser()->getFullName(), $content);

            return $this->render('order/confirm.html.twig', [
                'order' => $order,
                'total_price' => $total_price,
            ]);
        }
        else{
            return $this->redirectToRoute('app_home');
        }
    }
}
