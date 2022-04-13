<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class ApiUserController extends AbstractController
{
    const NOT_LOGGED = "Vous n'êtes pas connecté.";

    /**
     * @Route("mon-api/user", name="api_current_user", methods={"GET"})
     */
    public function index(SerializerInterface $serializer, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        if ($user != null) {
            $order = $userRepository->findOneByEmail($user->getEmail());
            $json = $serializer->serialize($order, 'json', [
                'groups' => 'user:read',
            ]);
            return new Response($json, 200, []);
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }

    /**
     * @Route("mon-api/user/{id}", name="api_user_id", methods={"GET"})
     */
    public function api_user_id(SerializerInterface $serializer, UserRepository $userRepository, $id): Response
    {
        $logged = $this->getUser();

        if ($logged != null) {
            if ($userRepository->findById($id) != null) {
                $user = $userRepository->findById($id);
                $json = $serializer->serialize($user, 'json', [
                    'groups' => 'user:read',
                ]);
                return new Response($json, 200, []);
            } else {
                return new Response("L'utilisateur recherché n'existe pas.", 401, []);
            }
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }

    /**
     * @Route("mon-api/register", name="api_user_add", methods={"POST"})
     */
    public function add_user(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder): Response
    {
        $json = $request->getContent();

        try {
            $user = $serializer->deserialize($json, User::class, 'json');
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json($user, 201, [], [
                'groups' => 'user:read'
            ]);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'message' => "The error message explaining what went wrong."
            ], 404);
        }
    }

    /**
     * @Route("mon-api/user", name="edit_current_user", methods={"PUT"})
     */
    public function edit_user(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager,  UserPasswordEncoderInterface $encoder)
    {
        $user = $entityManager->getRepository(User::class)->findOneByEmail($this->getUser()->getEmail());
        //       dd($user);
        $json = $request->getContent();
        $decode = $serializer->deserialize($json, User::class, 'json');

        if ($user != null) {
            $user->setEmail($decode->getEmail());
            $user->setfirstname($decode->getfirstname());
            $user->setlastname($decode->getlastname());
            $password = $encoder->encodePassword($decode, $decode->getPassword());
            $user->setPassword($password);
            $entityManager->flush();
            return $this->json($user, 200, [], [
                'groups' => 'user:read'
            ]);
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }

    /**
     * @Route("mon-api/user", name="remove_current_user", methods={"DELETE"})
     */
    public function remove_current_user(EntityManagerInterface $entityManager)
    {
        if ($this->getUser() != null) {
            $user = $entityManager->getRepository(User::class)->findOneByEmail($this->getUser()->getEmail());
            $entityManager->remove($user);
            $entityManager->flush();
            return new Response("L'utilisateur à bien été supprimer.", 200, []);
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }
}
