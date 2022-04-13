<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) { // doctrine
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/inscription", name="app_register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $notification_valid = null;
        $notification_false = null;
        $user = new User();
        $mail = new Mail();

        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if (!$search_email) {
                $password = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);

                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification_valid = "Votre inscription a bien été prise en compte.";
                $content = "Bonjour ".$user->getFullName()."<br/>Bienvenue sur la première boutique de vente de pièce 100% compatible.<br><br/>Vous trouvez une large gamme de materiel informatique compatible avec tout type de marque.<br/>ENJOY!";
                $mail->send($user->getEmail(), $user->getFullName(), 'Bienvenue sur BIGDEAL - Vente de piece 100% Compatible', $user->getFullName(), $content);
            } else {
                $notification_false = "L'email que vous avez renseigné existe déjà.";
            }
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification_valid' => $notification_valid,
            'notification_false' => $notification_false
        ]);
    }
}
