<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class ApiProductController extends AbstractController
{
    const NOT_LOGGED = "Vous n'êtes pas connecté.";

    /**
     * @Route("mon-api/product/", name="api_product", methods={"GET"})
     */
    public function index(SerializerInterface $serializer, ProductRepository $productRepository): Response
    {
        //  $order = $productRepository->findAll();
        //   $json = $serializer->serialize($order,'json', [
        //       'groups' => 'product:read',
        //   ]);
        // return new Response($json, 200, []);
        return $this->json($productRepository->findAll(), 200, [], [
            'groups' => 'product:read',
            ]);
    }

    /**
     * @Route("mon-api/product/{id}", name="api_product_id", methods={"GET"})
     */
    public function getProductById(SerializerInterface $serializer, ProductRepository $productRepository, $id): Response
    {
        $product = $productRepository->findById($id);

        if ($product) {
            $json = $serializer->serialize($product, 'json', [
                'groups' => 'product:read',
            ]);
            return new Response($json, 200, []);
        } else {
            return new Response("Le produit n'as pas été trouver", 400, []);
        }
    }

    /**
     * @Route("mon-api/product", name="api_product_add", methods={"POST"})
     */
    public function api_add_product(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        $json = $request->getContent();
        $user = $this->getUser();

        if ($user != null) {
            try {
                $product = $serializer->deserialize($json, Product::class, 'json');
                $entityManager->persist($product);
                $entityManager->flush();
                //  dd($product);

                return $this->json($product, 201, [], [
                    'groups' => 'product:read'
                ]);
            } catch (NotEncodableValueException $e) {
                return $this->json([
                    'message' => "The error message explaining what went wrong."
                ], 404);
            }
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }

    /**
     * @Route("mon-api/product/{id}", name="api_product_remove", methods={"DELETE"})
     */
    public function api_remove_product(EntityManagerInterface $entityManager, $id): Response
    {
        $product = $entityManager->getRepository(Product::class)->findOneById($id);
        $user = $this->getUser();

        if ($user != null) {
            $entityManager->remove($product);
            $entityManager->flush();
            return new Response("Le produit à bien été supprimé.", 200, []);
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }

    /**
     * @Route("mon-api/product/{id}", name="api_product_edit", methods={"PUT"})
     */
    public function api_product_edit(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, $id): Response
    {
        $user = $this->getUser();
        $json = $request->getContent();
        $decoded = $serializer->deserialize($json, Product::class, 'json');
        $product = $entityManager->getRepository(Product::class)->findOneById($id);
        if ($user != null) {
            $product->setName($decoded->getName());
            $product->setSlug($decoded->getSlug());
            $product->setillustration($decoded->getillustration());
            $product->setsubtitle($decoded->getsubtitle());
            $product->setdescription($decoded->getdescription());
            $product->setPrice($decoded->getprice());
            $product->setcategory($decoded->getcategory());
            $product->setisBest($decoded->getisBest());
            $product->setisNew($decoded->getisNew());

            $entityManager->flush();

            return $this->json($product, 200, [], [
                'groups' => 'product:read'
            ]);
        } else {
            return new Response(self::NOT_LOGGED, 401, []);
        }
    }
}
