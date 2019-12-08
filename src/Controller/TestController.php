<?php

namespace App\Controller;

use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }


    /**
     * @Route("/db")
     */

    public function createTest(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $test = new Test();
        $test->setName('name1');
        $test->setPrice(123);

        $repository = $this->getDoctrine()->getRepository( Test::class);
        $tests = $repository->findAll();

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($test);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id ' . $test->getId());
    }

    /**
     * @Route("/show")
     */

    public function show()
    {
        $tests = $this->getDoctrine()
            ->getRepository(Test::class)
            ->findAll();


        if (!$tests) {
            throw $this->createNotFoundException(
                'No event found'
            );
        }

        return $this->render(
            'test/show.html.twig', ['tests' => $tests]);
    }



}
