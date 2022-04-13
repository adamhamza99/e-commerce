<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\ContactType;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, FlashyNotifier $flashyNotifier): Response
    {
        $mail = new Mail();
        $notification_valid = null;
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            // $prenom = $data[Prenom];
            //   dd($data[Prenom]);
            $notification_valid = "Merci de nous avoir contacté. Notre équipe va vous répondre dans les plus bref délais.";
            $content = "<b>Nom : </b>".$data['Prenom']." ".$data['Nom']."<br/><b>Message: </b>".$data['Message']."<br/><br/><b>Email : </b>".$data['Email']." ";
            $mail->send("bigdeal@yopmail.com","BIGDEAL", "Demande de contact", "BIGDEAL SUPPORT", $content);

        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'notification_valid' => $notification_valid
        ]);
    }
}
