<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', []);
    }

    #[Route('/', name: 'about')]
    public function about(): Response
    {
        return $this->render('page/index.html.twig', []);
    }

    #[Route('/', name: 'service')]
    public function service(): Response
    {
        return $this->render('page/index.html.twig', []);
    }

    #[Route('/', name: 'product')]
    public function product(): Response
    {
        return $this->render('page/index.html.twig', []);
    }
}

