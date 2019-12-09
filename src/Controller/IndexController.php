<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
    * @Route("/" ,name="index-start")
    */
    public function index()
    {

        return $this->render('index.html.twig');
    }

    /**
     * @Route("/about/{id}")
     */
    public function about($id)
    {



        return $this->render('about.html.twig', [
            'name' => 'post'
        ]);
    }

    /**
     * @Route("/name")
     */
    public function name()
    {

        return $this->render('name.html.twig', [
            'name' => 'Nick'
        ]);
    }
}