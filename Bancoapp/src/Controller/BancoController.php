<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BancoController extends AbstractController
{
    #[Route('/banco', name: 'app_banco')]
    public function index(): Response
    {
        return $this->render('banco/index.html.twig', [
            'controller_name' => 'BancoController',
        ]);
    }
}
