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
}