<?php

namespace App\Controller;

use App\Entity\AppJuanma;
use App\Entity\Dinero;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class AppController extends AbstractController
{
    #[Route('/app', name: 'app_app')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    #[Route('/nuevo', name: 'nuevo_usuario')]
    public function nuevo(ManagerRegistry $doctrine, Request $request) {

        $user = new AppJuanma(); //AppJuanma es la BD donde se guardan los usuarios
    
        $formulario = $this->createForm(UserType::class, $user);
        $formulario->handleRequest($request);
        
            
        if ($formulario->isSubmitted() && $formulario->isValid()) {
    
            $user = $formulario->getData();
    
            $entityManager = $doctrine->getManager();
    
            $entityManager->persist($user);
    
            $entityManager->flush();
    
        }
    
        return $this->render('nuevo.html.twig', array(
    
            'formulario' => $formulario->createView()
    
        ));
    

        
    }


}
